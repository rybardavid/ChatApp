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
      $user = Auth::user();
      $status = $user->Status()->first();
      $status->online = true;
      $status->save();
      UserStatusEvent::dispatch(true,$user->id);

      return view('main');
    }
  }

  public function logout(){
    $user = Auth::user();
    $status = $user->Status()->first();
    $status->online = false;
    $status->save();
    UserStatusEvent::dispatch(false,$user->id);
    Auth::logout();
    return redirect('/login');
  }
}
