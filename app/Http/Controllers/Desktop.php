<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Produccion\Pedido;
use App\Models\Produccion\Pedido_servicio;
use App\Models\Produccion\Servicio;
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
	public function showAdmin(){
    $pedidos = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [date('Y-m-01'), date('Y-m-d')])->get();
    $pt = $pedidos->count();
    $pi = Pedido::incompletas()->count();
    $materiales = Solicitud_material::whereIn('pedido_id', $pedidos->map(function($p){return $p->id;})->toArray())->get();
    $servicios = Servicio::where('empresa_id', Auth::user()->empresa_id)->get();
    $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->where('seguimiento', 1)->get();
		return view('desktop', compact('clientes', 'pedidos', 'pt', 'pi', 'servicios', 'materiales'));
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
