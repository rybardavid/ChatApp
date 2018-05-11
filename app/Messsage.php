<?php

namespace App;

use App\LittleSolutions\LittlePaginte;
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

    public static function LitPaginate($conversationID, $perPages, $pageId)
    {
      $lit = new LittlePaginte('messsages');
      return $lit->LitPaginate($conversationID, $perPages, $pageId);
    }
}
