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

class HomeControllerChatsAPI extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin-api');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    // Show Contact list, Recent Chat User List, and Group list
    $collection = User::where('id', '!=', Auth::id())->orderBy('name')->get();
    $contacts = $collection;
    // $contacts = $collection->groupBy(function ($item) {
    //     return substr(Str::lower($item->name), 0, 1);
    // });

    $users = DB::select("SELECT chatdata.*,users.id,users.name,users.avatar from (SELECT t1.*, CASE WHEN t1.from_user != " . Auth::id() . " THEN t1.from_user ELSE t1.to_user END AS userid , (SELECT SUM(is_read=0) as unread FROM `chat_messages` WHERE chat_messages.to_user=" . Auth::id() . " AND chat_messages.from_user=userid GROUP BY chat_messages.from_user) as unread
    FROM chat_messages AS t1
    INNER JOIN
    (
        SELECT
            LEAST(`from_user`, `to_user`) AS sender_id,
            GREATEST(`from_user`, `to_user`) AS receiver_id,
            MAX(id) AS max_id
        FROM chat_messages
        GROUP BY
            LEAST(sender_id, receiver_id),
            GREATEST(sender_id, receiver_id)
    ) AS t2
        ON LEAST(t1.`from_user`, t1.`to_user`) = t2.sender_id AND
        GREATEST(t1.`from_user`, t1.`to_user`) = t2.receiver_id AND
        t1.id = t2.max_id
        WHERE t1.`from_user` = " . Auth::id() . " OR t1.`to_user` =" . Auth::id() . ") chatdata JOIN users On users.id=userid  WHERE users.id !=" . Auth::id() . " ORDER BY chatdata.id DESC");
    $user_id = Auth::id();// Your DB logic here remains the same
   

    $AttachedFiles = Message::where(function ($query) use ($user_id) {
        $query->where('from_user', $user_id)->orWhere('to_user', $user_id);
    })->whereNotNull('file')->get();

    $groupdata = Group::with(['users' => function($query) use($user_id) {
        $query->select('group_id', 'is_read')->where('user_id', $user_id);
    }])->whereHas('groupUsers', function($query) use($user_id) {
        $query->where('user_id', '=', $user_id);
    })->get();

    return response()->json([
        'users' => $users,
        'contacts' => $contacts,
        'groupdata' => $groupdata,
        'attached_files' => $AttachedFiles,
    ]);
}

        public function getMessage($user_id)
        {
            $my_id = Auth::id();
            Message::where(['from_user' => $user_id, 'to_user' => $my_id])->update(['is_read' => 1]);

            $messages = Message::where(function ($query) use ($user_id, $my_id) {
                $query->where('from_user', $user_id)->where('to_user', $my_id);
            })->orWhere(function ($query) use ($user_id, $my_id) {
                $query->where('from_user', $my_id)->where('to_user', $user_id);
            })->get();

            $chatUser = User::find($user_id);

            return response()->json([
                'messages' => $messages,
                'chatUser' => $chatUser,
            ]);
        }

    public function getLastMessage($user_id)
    {
        $my_id = Auth::id();
        // Make read all unread message
        Message::where(['from_user' => $user_id, 'to_user' => $my_id])->update(['is_read' => 1]);
        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from_user', $user_id)->where('to_user', $my_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from_user', $my_id)->where('to_user', $user_id);
        })->orderBy('id', 'DESC')->limit(1)->get();
 
        $chatUser = User::find($user_id);

        return view('Chats::layouts.message-conversation')->with(['messages' => $messages])->with(['chatUser' => $chatUser]);
    }

    // Send Messages using pusher
    public function sendMessage(Request $request)
{
    $from = Auth::id();
    $to = $request->receiver_id;
    $message = $request->message;
    $file = $request->file;

    $data = new Message();
    $data->from_user = $from;
    $data->to_user = $to;
    $data->message = $message;

    if ($file != null) {
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $filepath = public_path('/Upload/');
        $file->move($filepath, $filename);
        $data->file = 'Upload/' . $filename;
    }

    $data->is_read = 0;
    $data->save();

    $options = [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'useTLS' => true,
    ];

    $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        $options
    );
    

    // $pusher->trigger('my-channel', 'my-event', [
    //     'from_user' => $from,
    //     'to_user' => $to,
    // ]);

    return response()->json([
        'status' => 'success',
        'data' => $data,
    ]);
}
    // File size convert bytes to mb,gb,...
    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Delete only selected message
    public function deleteMessage($id)
    {
        Message::where('id', $id)->delete();
    }

    // Delete selected users All messages(Conversation)
    public function deleteConversation($user_id)
    {
        $my_id = Auth::id();
        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from_user', $user_id)->where('to_user', $my_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from_user', $my_id)->where('to_user', $user_id);
        })->delete();
    }

    // Send Typing using Pusher
    public function sendTyping(Request $request)
    {
      
        $from = Auth::id();
        $to = $request->receiver_id;
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $data = ['from_user' => $from, 'to_user' => $to, 'typing' => true]; // showing typing notification when a user is typing a message
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
