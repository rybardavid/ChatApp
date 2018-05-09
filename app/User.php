<?php

namespace App;

use App\Traits\Friendable;
use App\Traits\Conversationable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;
    use Conversationable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Conversations()
    {
        return $this->belongsToMany('App\Conversation', 'user_conversation')->withTimestamps();
    }

    public function Friendships()
    {
        return $this->hasMany('App\friendship');
    }

    public function Messages()
    {
        return $this->hasMany('App\Messsage');
    }
}
