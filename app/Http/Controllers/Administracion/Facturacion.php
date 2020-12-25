<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\Administracion\Factura;
use App\Models\Ventas\Cliente;
use App\Models\Sistema\Fact_empr;

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
    $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();
    $empresas = Fact_empr::where('empresa_id', Auth::user()->empresa_id)->get();
		return view('Administracion.facturas', compact('clientes', 'empresas'));
	}

	public function getFacts(Request $request){
    $data = Factura::select('numero', 'cliente_id', 'emision', 'tipo', 'estado', 'id')->where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [$request->fechaini, $request->fechafin])->where(function($query) use($request){
      // if($request->cliente){
      //   $query->where('', $request->cliente)
      // }
      // if($request->empresa){
      //   $query->where('', $request->empresa)
      // }
      // if($request->tipo){
      //   $query->where('', $request->tipo)
      // }
      // if($request->estado){
      //   $query->where('', $request->estado)
      // }
    })->get();
		return response()->json(array('data' => $data));
	}

}
