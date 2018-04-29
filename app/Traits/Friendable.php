<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Friendship;
use App\User;

trait Friendable
{

  public function addFriend()
  {
      $request  = Friendship::where(function($query) use($user_requested_id){
                              $query->where('requester', $user_requested_id)
                                    ->where('user_requested', $this->id);
                            })
                            ->orWhere(function($query) use($user_requested_id){
                              $query->where('requester', $this->id)
                                    ->where('user_requested', $user_requested_id);
                            })->first();

      if($request){
        return "request was send before";
      }

      $friendship = Friendship::create([
        'requester' => $this->id,
        'user_requested' => $user_requested_id,
      ]);

      if($friendship){
        return "OK";
      }
      else {
        return "Fail";
      }        
  }


}
