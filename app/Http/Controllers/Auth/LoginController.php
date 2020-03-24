<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App;
use Auth;
use Log;
use Session;

class LoginController extends Controller
{

  use AuthenticatesUsers;

  protected $redirectTo = 'desktop';

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function show(){
    if(Auth::check()){
      return redirect('desktop');
    } else {
      return view('auth.login');
    }
  }

  public function login(Request $request){
    $credentials = array(
      'usuario' => $request->get('usuario'),
      'password' => $request->get('password'), 
      'cedula' => $request->get('cedula'), 
      'activo' => 1 
    );
    if(Auth::guard('usuario')->attempt($credentials)){
      return redirect()->route('desktop');
    } else {
      $request->session()->flash('message', "Invalid Credentials , Please try again.");
      $request->session()->flash('old', array('usuario'=>$request->get('usuario'), 'pasword'=>$request->get('password'), 'cedula'=>$request->get('cedula'), 'remember'=>$request->get('remember')) );
      return view('auth.login');
    }
  }
}
