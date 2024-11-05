<?php

namespace Modules\Chats\Src\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'chat_group_users';
    protected $fillable = ['group_id', 'user_id'];

    public function userInfo()
    { 
        return $this->hasOne('App\Models\User', 'id');
    }
}
