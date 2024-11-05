<?php

namespace Modules\Chats\Src\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'chat_messages'; // Change 'conversations' to your actual table name if different

    protected $fillable = ['from_user', 'to_user', 'message', 'file', 'is_read'];
    
}
