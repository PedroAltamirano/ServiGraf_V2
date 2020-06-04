<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App;
use Session;

class Facturacion extends Controller
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
		return view('Administracion/facturas', ['nombre_empresa' => 'ServiGraf']);
	}
  
	public function getFacts(){
    $data = DB::connection('DDBBcontabilidad')->select('SELECT numero, cliente_id, emision, tipo, estado, id FROM `facturas` WHERE `empresa_id`= ? AND `emision` BETWEEN ? AND ? ? ? ? ORDER BY `numero` DESC', ['SVGF', '2020-4-8', '2020-4-11', '', '', '']);
		return response()->json(array('data' => $data));
	}

}