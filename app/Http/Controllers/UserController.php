<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function sendRequest(Request $request)
    {
      $response = Auth::user()->addFriend($request['id']);
      return $response;
    }

    public function getNonFriendsUsers()
    {
      $id = Auth::id();
      return Auth::user()->getPeople($id);
    }
}
