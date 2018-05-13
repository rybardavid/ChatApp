<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Auth;

class CommunicationConroller extends Controller
{

    public function getConversations()
    {
      return Auth::user()->getConversations();
    }

    public function sendMessage(Request $request)
    {
      return Auth::user()->sendMessage($request);
    }

    public function messagePaginate(Request $request)
    {
      $perPage = 14;
      return Auth::user()->messagePaginate($request['chatID'],$perPage,$request['pageID']);
    }
}
