<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class friendship extends Model
{
    protected $fillable = [
        'requester', 'user_requested', 'status',
    ];

    public function Conversation()
    {
        return $this->hasOne('App\ReugularConversation');
    }

}
