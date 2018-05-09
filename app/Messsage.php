<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messsage extends Model
{
    public function User()
    {
      return $this->belongsTo('App\User');
    }

    public function Conversation()
    {
      return $this->belongsTo('App\ReugularConversation');
    }
}
