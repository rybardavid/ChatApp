<?php

namespace App\Traits;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use App\Events\NotifyPrivateEvent;
use App\ReugularConversation;
use App\Friendship;
use App\User;

trait Friendable
{

  public function getUsers($myID)
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

  public function getFriends()
  {

      if( Friendship::where('status', 1)->exists())
      {
        $userId = $this->id;
        $friendshipsList = Friendship::where('status', 1)
                                     ->where(function($query) use($userId) {
                                        $query->where('requester', $userId)
                                              ->orWhere('user_requested', $userId);
                                     })->get();

        foreach ($friendshipsList as $key => $friendship)
        {
          if($friendship->requester != $userId)
          {
              $friendList[] = User::where('id', $friendship->requester)->first();
          }
          else
          {
              $friendList[] = User::where('id', $friendship->user_requested)->first();
          }

        }



        if(isset($friendList))
        {
          return json_encode($friendList , JSON_FORCE_OBJECT);
        }
        else
        {
          return Response::json('Cant find any friends.',202);
        }
      }
      return Response::json('',204);
  }

  public function getRequests()
  {
    if(Friendship::where('status', 0)->exists())
    {
      $requests = Friendship::where('status', 0)
                                   ->where('user_requested', $this->id)
                                   ->get();

      foreach ($requests as $key => $request)
      {
        if(User::where('id', $request->requester)->exists())
        {
          $requester = User::where('id', $request->requester)->first();
          $requestsInfo[] = array("request" => $request, "requester" => $requester);
        }
        else
        {
          Friendship::where('requester', $request->requester)->delete();
        }
      }

      if(isset($requestsInfo))
      {
        return json_encode($requestsInfo , JSON_FORCE_OBJECT);
      }
      else
      {
        return Response::json('Dont have any requests.', 202);
      }

    }

    return Response::json('Dont have any requests.', 202);
  }

  public function sendRequest($userRequesedId)
  {
      $request  = Friendship::where(function($query) use($userRequesedId){
                              $query->where('requester', $userRequesedId)
                                    ->where('user_requested', $this->id);
                            })
                            ->orWhere(function($query) use($userRequesedId){
                              $query->where('requester', $this->id)
                                    ->where('user_requested', $userRequesedId);
                            })->first();

      if($request){
        return Response::json('Request was sent before.', 202);
      }

      $friendship = Friendship::create([
        'requester' => $this->id,
        'user_requested' => $userRequesedId,
      ]);

      if($friendship){
        return Response::json('Request was sent.', 200);
      }
      else {
        return Response::json('Request was not able to send.', 400);
      }
  }

  public function removeFriend($friendUserId)
  {
      $friendships = DB::table('friendships');

      $friendship = $friendships->where('status', 1)
                                ->where(function($query) use($friendUserId) {
                                  $query->where('requester', $friendUserId)
                                        ->where('user_requested', $this->id);
                                })
                                ->orWhere(function($query) use($friendUserId) {
                                  $query->where('requester', $this->id)
                                        ->where('user_requested', $friendUserId);
                                })->delete();

      return Response::json('Friend was removed', 200);
  }

  public function acceptRequest($requesterId)
  {
      $friendship = Friendship::where('requester',$requesterId)
                              ->where('user_requested',$this->id)
                              ->first();

      if(isset($friendship))
      {
      /*  $friendship->update([
          'status' => 1
        ]);*/

        $user = User::find($this->id);
        $notificationObj = array(
                                  'type' => 'acceptReuqest',
                                  'user' => $user,
                                  'conversation' => $friendship
                                );

        NotifyPrivateEvent::dispatch($notificationObj,$requesterId);
        return Response::json('Request was accepted.', 200);
      }

      return Response::json('Acception of request faild.', 202);
  }

}
