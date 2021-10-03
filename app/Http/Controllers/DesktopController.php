<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Ventas\Cliente;
use App\Models\Produccion\Pedido;
use App\Models\Produccion\Proceso;
use App\Models\Produccion\Pedido_proceso;
use App\Models\Produccion\Solicitud_material;

class DesktopController extends Controller
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
  public function showAdmin(Request $request)
  {
    $user = Auth::user();
    if ($request->get('fecha')) {
      $dateInit = date('Y-m-01', strtotime($request->get('fecha')));
      $dateFin = date('Y-m-t', strtotime($request->get('fecha')));
    } else {
      $dateInit = date('Y-m-01');
      $dateFin = date('Y-m-t');
    }
    $fecha = $request->get('fecha') ?? date('Y-m-d');
    // dd($dateInit, $dateFin);

    $pedidos = Pedido::where('empresa_id', $user->empresa_id)
      ->whereBetween('fecha_entrada', [$dateInit, $dateFin])
      ->get();

    $pedidos_terminados = $pedidos->count();
    $pedidos_incompletos = Pedido::incompletas($request->get('fecha'))->count();
    $progreso = $pedidos_terminados > 0 ? (abs($pedidos_terminados - $pedidos_incompletos) * 100) / $pedidos_terminados : 0;

    $pedidos_array = $pedidos->pluck('id')->toArray();

    $materiales = Solicitud_material::whereIn('pedido_id', $pedidos_array)->get();

    $procesos = Proceso::where('empresa_id', $user->empresa_id)->get();

    $clientes = Cliente::where('empresa_id', $user->empresa_id)
      ->where('seguimiento', 1)
      ->with(['contacto', 'empresa'])
      ->orderBy('cliente_empresa_id')
      ->get();

    $utilidades = Pedido::where('empresa_id', $user->empresa_id)
      ->whereBetween('fecha_entrada', [$dateInit, $dateFin])
      ->where('cotizado', '>', 0)
      ->with('cliente')
      ->get()
      ->each(function ($u) {
        $u->utilidad = $u->cotizado - $u->total_pedido;
      }); // TODO: modify query to raw

    return view('desktop', compact('clientes', 'pedidos', 'pedidos_terminados', 'pedidos_incompletos', 'progreso', 'pedidos_array', 'procesos', 'materiales', 'fecha', 'utilidades'));
  }

  public function show()
  {
    $pedidos_array = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [date('Y-m-01'), date('Y-m-d')])->pluck('id')->toArray();
    Pedido::$own = true;
    $clientes = auth()->user()->clientes;
    $procesos = auth()->user()->procesos;
    $pedidos = Pedido::incompletas();
    return view('tablero', compact('pedidos', 'clientes', 'procesos', 'pedidos_array'));
  }
}
