<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Auth;

class CommunicationConroller extends Controller
{
    /*public function testMsg()
    {
        $convId = 4;
        $message = "fhdsuifndsnfj dfs ndsihfnusdinfi fhdsui";

        $conv = ReugularConversation::where('id', $convId)->first();

        if(isset($conv))
        {
           $status = $conv->Friendship()->pluck('status');
           $status = (integer)$status[0];

           if($status)
           {
              $message = new Messsage;
              $message->user_id = Auth::id();
              $message->conversation_id = $convId;
              $message->body = "jkurvap ico";
              $message->save();
              return Response::json('message was sent',200);
           }
           else
           {
             return Response::json('Friendship doesnt exists.',202);
           }
        }
        else
        {
           return Response::json('Friendship doesnt exists.',202);
        }

        $friendship = $conv->Friendship()->get();

        return $friendship;
    }

    public function getConversations()
    {
      $userId = Auth::id();
      $friendshipsIDs = friendship::where('status', 1)
                               ->where(function($query) use($userId) {
                                       $query->where('requester', $userId)
                                             ->orWhere('user_requested', $userId);
                                       })
                                       ->pluck('id');

      $reuqusters = friendship::where('status', 1)
                              ->where(function($query) use($userId) {
                                        $query->where('requester', $userId)
                                              ->orWhere('user_requested', $userId);
                                      })
                                      ->pluck('requester');

      $user_requesteds = friendship::where('status', 1)
                                   ->where(function($query) use($userId) {
                                                $query->where('requester', $userId)
                                                      ->orWhere('user_requested', $userId);
                                            })
                                            ->pluck('user_requested');
      return $friendships;
      $friendships = friendship::find($friendshipsIDs);
      return $friendships;


      return $conversations;
    }

    */

    public function getConversations()
    {
      return Auth::user()->getConversations();
    }
}
