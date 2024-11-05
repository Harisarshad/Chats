<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Modules\Chats\Src\Controllers\HomeControllerChats;

use Modules\Chats\Src\Controllers\UserController;
use Modules\Chats\Src\Controllers\GroupController;
Route::middleware(['web','twofactor','XSS'])->group(function () {
Route::get('/chathome', [HomeControllerChats::class, 'index'])->middleware(['XSS']);
Route::get('/chatlms', [HomeControllerChats::class, 'chat']);

// Message
Route::get('/message/{id}', [HomeControllerChats::class, 'getMessage'])->name('message');
Route::post('message', [HomeControllerChats::class, 'sendMessage']);
Route::post('typing', [HomeControllerChats::class, 'sendTyping']);
Route::get('/lastmessage/{id}', [HomeControllerChats::class, 'getLastMessage']);

// Update avatar
Route::post('/updateavatar', [UserController::class, 'update'])->name('updateavatar');

// Update Name
Route::post('/nameupdate', [UserController::class, 'nameupdate'])->name('nameupdate');

// Delete Contact
Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('contact.destroy');

// Search Contact
Route::get('/search', [UserController::class, 'search']);

// Search Recent Contact
Route::get('/recentsearch', [UserController::class, 'recentsearch']);

// Chat Message Search
Route::get('/messagesearch', [UserController::class, 'messagesearch']);

// Delete Message
Route::get('/deleteMessage/{id}', [HomeControllerChats::class, 'deleteMessage']);

// Delete Conversation
Route::get('/deleteConversation/{id}', [HomeControllerChats::class, 'deleteConversation'])->name('conversation.delete.chat');

// Group Create
Route::post('/groups', [GroupController::class, 'store'])->name('groups');

// Group Search
Route::get('/groupsearch', [GroupController::class, 'groupsearch']);

// Group Message
Route::get('/groupmessage/{id}', [GroupController::class, 'getGroupMessage'])->name('groupmessage');
Route::post('groupmessage', [GroupController::class, 'sendGroupMessage']);
Route::get('/grouplastmessage/{id}', [GroupController::class, 'getGroupLastMessage']);

// Delete Group Message
Route::get('/deletegroupmessage/{id}', [GroupController::class, 'deletegroupmessage']);

// Delete Group Conversation
Route::get('/deleteGroupConversation/{id}', [GroupController::class, 'deleteGroupConversation'])->name('groupconversation.delete');

// Group Message Search
Route::get('/groupmessagesearch', [GroupController::class, 'groupmessagesearch']);
});