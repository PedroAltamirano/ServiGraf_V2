<?php

namespace App\Http\Controllers;

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
	public function admin_index(){
		//if(Auth::user()->'modulo' == 10){
		//return view('Produccion.desktop', ['nombre_empresa' => $this->nombre_empresa()]);
		return view('desktop', ['nombre_empresa' => 'ServiGraf']);
		/*} else {
				index();
		}*/
	}

	public function index(){
		return view('tablero', ['nombre_empresa' => 'ServiGraf']);
	}
	
	/*public function nombre_empresa(){
		$nombre_empresa = App\Empresas::where('id', Auth::user()->empresa_id)->value('nombre');
		return $nombre_empresa;
	}*/

}