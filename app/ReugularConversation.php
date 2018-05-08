<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReugularConversation extends Model
{
    public function Friendship()
    {
        return $this->belongsTo('App\friendship');
    }
}
