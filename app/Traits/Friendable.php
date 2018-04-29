<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Friendship;
use App\User;

trait Friendable
{

  public function addFriend($user_requested_id)
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

  public function getPeople($myID)
  {
      $friendships = DB::table('friendships');

      $myFriednships = $friendships->where('requester', $myID)
                                   ->orWhere('user_requested', $myID)->get();

      foreach ($myFriednships as $key => $friendship)
      {
        if($friendship->requester != $myID){
          $avoidedUsersId[] = $friendship->requester;
        }

        if($friendship->user_requested != $myID){
          $avoidedUsersId[] = $friendship->user_requested;
        }
      }

      $avoidedUsersId[] = $myID;

      $users = User::whereNotIn('id',$avoidedUsersId)->get();
      return json_encode($users , JSON_FORCE_OBJECT);
  }

}
