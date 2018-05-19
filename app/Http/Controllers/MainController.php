<?php

namespace App\Http\Controllers;

use App\Events\UserStatusEvent;
use Illuminate\Http\Request;
use Auth;

class MainController extends Controller
{
  public function mainPage()
  {
    if(Auth::guest())
    {
      return redirect('/login');
    }
    else
    {
      UserStatusEvent::dispatch(true,Auth::id());
      return view('main');
    }
  }

  public function logout(){
    UserStatusEvent::dispatch(false,Auth::id());
    Auth::logout();
    return redirect('/login');
  }
}
