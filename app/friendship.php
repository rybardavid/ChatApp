<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class friendship extends Model
{
    protected $fillable = [
        'requester', 'user_requested', 'status',
    ];

    public function Conversations()
    {
        return $this->hasMany('App\Conversation');
    }

    public function ReuglarConversation()
    {
        return $this->hasOne('App\ReugularConversation');
    }
}
