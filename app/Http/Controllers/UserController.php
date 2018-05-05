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
      $requesterId = $request['requester'];
      //$response = Auth::user()->createOneToOne($requesterId);

      return Auth::user()->createOneToOne($requesterId);

      if($response)
      {
          return Auth::user()->acceptRequest($requesterId);
      }
      else
      {
          return 'Fail';
      }

    }


    public function test()
    {
        return Auth::user()->testMore(3);
    }

}
