<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Modules\Chats\Src\Controllers\API\HomeControllerChatsAPI;
use Modules\Chats\Src\Controllers\API\GroupControllerAPI;
Route::group(['middleware' => ['auth:admin-api'], 'prefix' => 'api/v1/chats'], function () {
    Route::get('/', [HomeControllerChatsAPI::class, 'index'])->name('chats.index');

    // Get Messages from a User
    Route::get('/chats/messages/{user_id}', [HomeControllerChatsAPI::class, 'getMessage'])->name('chats.getMessage');

    // Get Last Message from a User
    Route::get('/chats/last-message/{user_id}', [HomeControllerChatsAPI::class, 'getLastMessage'])->name('chats.getLastMessage');

    // Send a Message
    Route::post('/send', [HomeControllerChatsAPI::class, 'sendMessage'])->name('chats.sendMessage');

    // Convert File Size to Human-readable Format (Optional utility endpoint)
    Route::get('/chats/convert-bytes/{bytes}', [HomeControllerChatsAPI::class, 'bytesToHuman'])->name('chats.bytesToHuman');

    // Delete a Single Message by ID
    Route::delete('/chats/message/{id}', [HomeControllerChatsAPI::class, 'deleteMessage'])->name('chats.deleteMessage');

    // Delete Entire Conversation with a User
    Route::delete('/chats/conversation/{user_id}', [HomeControllerChatsAPI::class, 'deleteConversation'])->name('chats.deleteConversation');

    // Send Typing Indicator
    Route::post('/chats/send-typing', [HomeControllerChatsAPI::class, 'sendTyping'])->name('chats.sendTyping');
});
Route::group(['middleware' => ['auth:admin-api'], 'prefix' => 'api/v1/groups'], function () {
    Route::post('/', [GroupControllerAPI::class, 'store'])->name('groups.store');
    Route::get('/{group_id}/messages', [GroupControllerAPI::class, 'getGroupMessage'])->name('groups.getMessages');
    Route::get('/{group_id}/last-message', [GroupControllerAPI::class, 'getGroupLastMessage'])->name('groups.getLastMessage');
    Route::post('/{group_id}/messages/send', [GroupControllerAPI::class, 'sendGroupMessage'])->name('groups.sendMessage');
    Route::get('search', [GroupControllerAPI::class, 'groupSearch'])->name('groups.search');
    Route::delete('/messages/{id}', [GroupControllerAPI::class, 'deleteGroupMessage'])->name('groups.deleteMessage');
    Route::delete('/{group_id}/conversations', [GroupControllerAPI::class, 'deleteGroupConversation'])->name('groups.deleteConversation');
    Route::get('/messages/search', [GroupControllerAPI::class, 'groupMessageSearch'])->name('groups.messageSearch');
});
