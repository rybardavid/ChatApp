<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function Users()
    {
       return $this->belongsToMany('App\User', 'user_conversation')->withTimestamps();
    }
}
