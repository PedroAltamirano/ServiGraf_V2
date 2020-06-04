<?php

namespace App\Http\Controllers;

use App\Security;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App;
use Auth;

class Desktop extends Controller
{
	use AuthenticatesUsers;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showAdmin(){
		if(Security::hasModule('10')){
			return view('desktop');
		} else {
			return redirect('tablero');
		}
	}

	public function show(){
		return view('tablero');
	}
}