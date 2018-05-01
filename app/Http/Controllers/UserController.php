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

    public function getRequests()
    {
      return Auth::user()->getRequests();
    }


    public function sendRequest(Request $request)
    {
      return Auth::user()->sendRequest($request['id']);
    }

    public function acceptRequest(Request $request)
    {
      return Auth::user()->acceptRequest($request['requester']);
    }
}
