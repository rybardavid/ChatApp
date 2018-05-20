<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function getUsers()
    {
      $id = Auth::id();
      return Auth::user()->getUsers($id);
    }

    public function getFriends()
    {
      return Auth::user()->getFriends();
    }

    public function getRequests()
    {
      return Auth::user()->getRequests();
    }


    public function sendRequest(Request $request)
    {
      return Auth::user()->sendRequest($request['id']);
    }

    public function removeFriend(Request $request)
    {

        $response =  Auth::user()->removeFriend($request['id']);
        if($response == true)
        {
          $requests = Auth::user()->getRequests();
          $conversations = Auth::user()->getConversations();

          $succesResponse = array(
                                    'requests' => $requests,
                                    'conversations' => $conversations
                                 );
          return json_encode($succesResponse , JSON_FORCE_OBJECT);                       
        }
    }

    public function acceptRequest(Request $request)
    {
      /*$friendshipID = $request['obj']['request']['id'];
      $requesterID = $request['obj']['requester']['id'];
      $response = Auth::user()->createOneToOne($friendshipID);
      return Auth::user()->acceptRequest($requesterID);*/

      $friendshipID = $request['obj']['request']['id'];
      $requesterID = $request['obj']['requester']['id'];
      Auth::user()->createOneToOne($friendshipID);

      $response = Auth::user()->acceptRequest($requesterID);

      if($response === true)
      {

          $requests = Auth::user()->getRequests();
          $conversations = Auth::user()->getConversations();

          $succesResponse = array(
                                    'requests' => $requests,
                                    'conversations' => $conversations
                                 );
          return json_encode($succesResponse , JSON_FORCE_OBJECT);
      }
      else
      {
          return $response;
      }

    }
}
