<?php

namespace Modules\Chats\Src\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'chat_groups'; // Change 'conversations' to your actual table name if different

    protected $fillable = ['group_name', 'description'];


    public function users()
    { 
        return $this->hasOne('Modules\Chats\Src\Models\GroupUser');
    }
    public static function get_file($path){
        
        return $path;
      }

    public function groupUsers()
    { 
        return $this->hasMany('Modules\Chats\Src\Models\GroupUser');
    }

}
