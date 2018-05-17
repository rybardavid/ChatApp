<?php

namespace App\Http\Controllers;

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
        
        return Auth::user()->removeFriend($request['id']);
    }

    public function acceptRequest(Request $request)
    {
      $friendshipID = $request['obj']['request']['id'];
      $requesterID = $request['obj']['requester']['id'];
      $response = Auth::user()->createOneToOne($friendshipID);
      return Auth::user()->acceptRequest($requesterID);
    }
}
