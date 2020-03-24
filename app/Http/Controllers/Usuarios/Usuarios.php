<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App;
use Auth;

class Usuarios extends Controller
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

	public function show(){
		return view('Usuarios/usuarios', ['nombre_empresa' => 'ServiGraf']);
	}
	
	/*public function nombre_empresa(){
		$nombre_empresa = App\Empresas::where('id', Auth::user()->empresa_id)->value('nombre');
		return $nombre_empresa;
	}*/

}