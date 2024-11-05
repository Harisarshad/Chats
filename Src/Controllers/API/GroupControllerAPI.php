<?php

namespace Modules\Chats\Src\Controllers\API; // Make sure this matches exactly

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\Chats\Src\Models\Message;
use App\Models\User;
use Modules\Chats\Src\Models\Group;
use Validator;
use Modules\Chats\Src\Models\GroupUser;
use Modules\Chats\Src\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use Pusher\Pusher;
use Illuminate\Support\Str;

class GroupControllerAPI extends Controller
{


   
        // Create a New Group and add users to it
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'group_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'checkVal' => 'required|array'
            ]);
    
            // Create new group
            $group = Group::create([
                'group_name' => $validatedData['group_name'],
                'description' => $validatedData['description']
            ]);
    
            // Add authenticated user as a group user
            GroupUser::create([
                'group_id' => $group->id,
                'user_id' => Auth::id()
            ]);
    
            // Add selected users to the group
            foreach ($validatedData['checkVal'] as $userId) {
                GroupUser::create([
                    'group_id' => $group->id,
                    'user_id' => $userId
                ]);
            }
    
            return response()->json([
                'message' => 'Group created successfully',
                'group' => $group
            ], 201);
        }
    
        // Get messages from a specific group
        public function getGroupMessage($group_id)
        {
            // Mark messages as read for the authenticated user
            GroupUser::where(['group_id' => $group_id, 'user_id' => Auth::id()])->update(['is_read' => 0]);
    
            // Fetch messages and group data
            $messages = Conversation::where('group_id', $group_id)->get();
            $groupData = Group::whereHas('groupUsers', function($query) {
                $query->where('user_id', Auth::id());
            })->where('id', $group_id)->first();
    
            $userData = DB::table('chat_group_users')
                ->join('users', 'chat_group_users.user_id', '=', 'users.id')
                ->select('chat_group_users.user_id', 'users.id', 'users.name', 'users.avatar')
                ->where('chat_group_users.group_id', $group_id)->get();
    
            return response()->json([
                'group' => $groupData,
                'messages' => $messages,
                'users' => $userData
            ]);
        }
    
        // Get the last message from a group
        public function getGroupLastMessage($group_id)
        {
            // Mark messages as read for the authenticated user
            GroupUser::where(['group_id' => $group_id, 'user_id' => Auth::id()])->update(['is_read' => 0]);
    
            // Fetch the last message
            $lastMessage = Conversation::where('group_id', $group_id)->orderBy('id', 'DESC')->first();
    
            return response()->json([
                'last_message' => $lastMessage
            ]);
        }
    
        // Send a message to a group
        public function sendGroupMessage(Request $request)
        {
            $validatedData = $request->validate([
                'group_id' => 'required|integer|exists:chat_groups,id',
                'message' => 'required|string',
                'file' => 'nullable|file'
            ]);
    
            $from_user_id = Auth::id();
            $group_id = $validatedData['group_id'];
            $message = $validatedData['message'];
           
            $file = $request->file;

         
          
    
            $conversation = new Conversation();
            $conversation->from_user_id = $from_user_id;
            $conversation->group_id = $group_id;
            $conversation->message = $message;
    
            // Handle file upload
            if ($file) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $filepath = public_path('/Upload/');
                $file->move($filepath, $filename);
                $conversation->file = 'Upload/' . $filename;
            }
            
            $conversation->save();
    
            // Mark all other users' messages as read
            DB::table('chat_group_users')
                ->where('group_id', $group_id)
                ->where('user_id', '!=', $from_user_id)
                ->increment('is_read');
    
            // Trigger Pusher event
            $this->triggerPusherEvent($from_user_id, $group_id);
    
            return response()->json([
                'message' => 'Message sent successfully',
                'conversation' => $conversation
            ], 201);
        }
    
        // Search for groups
        public function groupSearch(Request $request)
        {
       
            $validatedData = $request->validate([
                'search' => 'required|string|max:255'
            ]);
    
            $userId = Auth::id();
            $groupData = Group::with(['users' => function($query) use ($userId) {
                $query->select('group_id', 'is_read')->where('user_id', $userId);
            }])->whereHas('groupUsers', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->where('group_name', 'LIKE', '%' . $validatedData['search'] . '%')->get();
    
            return response()->json([
                'groups' => $groupData
            ]);
        }
    
        // Delete a group message
        public function deleteGroupMessage($id)
        {
            $message = Conversation::find($id);
            if (!$message) {
                return response()->json(['message' => 'Message not found'], 404);
            }
    
            $message->delete();
            return response()->json(['message' => 'Message deleted successfully']);
        }
    
        // Delete a group conversation
        public function deleteGroupConversation($group_id)
        {
            Conversation::where('group_id', $group_id)->delete();
            return response()->json(['message' => 'Group conversation deleted successfully']);
        }
    
        // Search for group messages
        public function groupMessageSearch(Request $request)
        {
            $validatedData = $request->validate([
                'search' => 'required|string|max:255',
                'groupid' => 'required|integer|exists:groups,id'
            ]);
    
            $messages = Conversation::where('group_id', $validatedData['groupid'])
                ->where('message', 'LIKE', '%' . $validatedData['search'] . "%")->get();
    
            $userData = DB::table('chat_group_users')
                ->join('users', 'chat_group_users.user_id', '=', 'users.id')
                ->select('chat_group_users.user_id', 'users.id', 'users.name', 'users.avatar')
                ->where('chat_group_users.group_id', $validatedData['groupid'])->get();
    
            return response()->json([
                'messages' => $messages,
                'users' => $userData
            ]);
        }
    
        // Helper method to trigger Pusher event
        private function triggerPusherEvent($from_user_id, $group_id)
        {
            $options = [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ];
            
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            
    
            $userData = DB::table('chat_group_users')
                ->join('users', 'chat_group_users.user_id', '=', 'users.id')
                ->select('users.id')
                ->where('chat_group_users.group_id', $group_id)->get();
    
            $data = ['from_user_id' => $from_user_id, 'group_users' => $userData, 'group_id' => $group_id];
            $pusher->trigger('my-channel', 'my-group', $data);
        }
    }

