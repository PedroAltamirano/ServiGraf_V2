<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Produccion\Pedido;
use App\Models\Produccion\Pedido_proceso;
use App\Models\Produccion\Proceso;
use App\Models\Produccion\Solicitud_material;
use App\Models\Ventas\Cliente;

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
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showAdmin(Request $request){
    if($request->get('fecha')){
      $dateInit = date('Y-m-01', strtotime($request->get('fecha')));
      $dateFin = date('Y-m-t', strtotime($request->get('fecha')));
    } else {
      $dateInit = date('Y-m-01');
      $dateFin = date('Y-m-t');
    }
    $fecha = $request->get('fecha') ?? date('Y-m-d');
    // dd($dateInit, $dateFin);
    $pedidos = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [$dateInit, $dateFin])->get();
    $pt = $pedidos->count();
    $pi = Pedido::incompletas($request->get('fecha'))->count();
    $materiales = Solicitud_material::whereIn('pedido_id', $pedidos->map(function($p){return $p->id;})->toArray())->get();
    $procesos = Servicio::where('empresa_id', Auth::user()->empresa_id)->get();
    $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->where('seguimiento', 1)->orderBy('cliente_empresa_id')->get();
		return view('desktop', compact('clientes', 'pedidos', 'pt', 'pi', 'servicios', 'materiales', 'fecha'));
	}

	public function show(){
    Pedido::$own = true;
		$clientes = auth()->user()->clientes;
		$procesos = auth()->user()->procesos;
		$proc = $procesos->map(function($p){return $p->id;})->toArray();
		$pedidos = Pedido::incompletas();
		return view('tablero', compact('pedidos', 'clientes', 'procesos'));
	}
}
