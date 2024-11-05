<?php

namespace Modules\Chats\Src\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'chat_conversations'; // Change 'conversations' to your actual table name if different

    protected $fillable = ['group_id', 'from_user_id', 'message', 'file'];
}
