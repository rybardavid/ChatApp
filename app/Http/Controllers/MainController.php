<?php

namespace App\Http\Controllers;

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
      return view('main');
    }
  }

  public function logout(){
    Auth::logout();
    return redirect('/login');
  }
}
