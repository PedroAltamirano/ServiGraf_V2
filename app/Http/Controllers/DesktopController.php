<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Ventas\Cliente;
use App\Models\Produccion\Pedido;
use App\Models\Produccion\Proceso;
use App\Models\Produccion\Pedido_proceso;
use App\Models\Produccion\Solicitud_material;
use stdClass;

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

    $pedidos = Pedido::where('empresa_id', $user->empresa_id)
      ->whereBetween('fecha_entrada', [$dateInit, $dateFin])
      ->get();
    $pedidos_array = $pedidos->pluck('id')->toArray();

    $progreso = $this->progreso($user, $pedidos, $request->get('fecha'));

    $interna = $this->interna($user, $pedidos_array);
    $externa = $this->externa($user, $pedidos_array);

    $estado = $this->estado($user, $pedidos);

    $material = $this->material($user, $pedidos_array);

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

    return view('desktop', compact('fecha', 'pedidos', 'progreso', 'interna', 'externa', 'estado', 'material', 'clientes', 'utilidades'));
  }

  private function progreso($user, $pedidos, $fecha)
  {
    $pedidos = $pedidos->count();

    $incompletos = Pedido::incompletas($fecha)->count();
    $progreso = $pedidos > 0 ? (abs($pedidos - $incompletos) * 100) / $pedidos : 0;

    return ['pedidos' => $pedidos, 'incompletos' => $incompletos, 'progreso' => $progreso];
  }

  private function interna($user, $pedidos_array)
  {
    $procesos_array = Proceso::where('empresa_id', $user->empresa_id)->where('tipo', 1)->pluck('id')->toArray();

    $items = Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))
      ->whereIn('pedido_id', $pedidos_array)
      ->whereIn('proceso_id', $procesos_array)
      ->with('proceso')
      ->groupBy('proceso_id')
      ->get()
      ->each(function ($i) {
        return $i->nombre = $i->proceso->proceso;
      });

    // Para JSON chart
    $data = $items->pluck('totalData');
    $labels = $items->pluck('nombre');

    return ['items' => $items, 'data' => $data, 'labels' => $labels];
  }

  private function externa($user, $pedidos_array)
  {
    $procesos_array = Proceso::where('empresa_id', $user->empresa_id)->where('tipo', 0)->pluck('id')->toArray();

    $items = Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))
      ->whereIn('pedido_id', $pedidos_array)
      ->whereIn('proceso_id', $procesos_array)
      ->with('proceso')
      ->groupBy('proceso_id')
      ->get()
      ->each(function ($i) {
        return $i->nombre = $i->proceso->proceso;
      });

    // Para JSON chart
    $data = $items->pluck('totalData');
    $labels = $items->pluck('nombre');

    return ['items' => $items, 'data' => $data, 'labels' => $labels];
  }

  private function estado($user, $pedidos)
  {
    $pedidos_pendientes = $pedidos->where('estado', 1);
    $pendientes = new stdClass();
    $pendientes->nombre = 'Pendientes';
    $pendientes->totalData = $pedidos_pendientes->count();
    $pendientes->economic = $pedidos_pendientes->sum('total_pedido');

    $pedidos_pagadas = $pedidos->where('estado', 2);
    $pagadas = new Stdclass();
    $pagadas->nombre = 'Pagadas';
    $pagadas->totalData = $pedidos_pagadas->count();
    $pagadas->economic = $pedidos_pagadas->sum('total_pedido');

    $pedidos_anuladas = $pedidos->where('estado', 3);
    $anuladas = new Stdclass();
    $anuladas->nombre = 'Anuladas';
    $anuladas->totalData = $pedidos_anuladas->count();
    $anuladas->economic = $pedidos_anuladas->sum('total_pedido');

    $pedidos_canjes = $pedidos->where('estado', 4);
    $canjes = new Stdclass();
    $canjes->nombre = 'Canje';
    $canjes->totalData = $pedidos_canjes->count();
    $canjes->economic = $pedidos_canjes->sum('total_pedido');

    $items = collect([$pendientes, $pagadas, $anuladas, $canjes]);

    // Para JSON chart
    $data = $items->pluck('totalData');
    $data2 = $items->pluck('economic');
    $labels = $items->pluck('nombre');

    return ['items' => $items, 'data' => $data, 'data2' => $data2, 'labels' => $labels];
  }

  private function material($user, $pedidos_array)
  {
    $items = Solicitud_material::select('material_id', DB::raw('sum(total) as totalData'))
      ->whereIn('pedido_id', $pedidos_array)
      ->with('material')
      ->groupBy('material_id')
      ->get()
      ->each(function ($i) {
        return $i->nombre = $i->material->descripcion;
      });

    // Para JSON chart
    $data = $items->pluck('totalData');
    $labels = $items->pluck('nombre');

    return ['items' => $items, 'data' => $data, 'labels' => $labels];
  }

  private function segumiento_clientes($user, $pedidos)
  {
    // $pedidos_id = $pedidos
    //   ->where('cliente_id', $cli->id)
    //   ->pluck('id')
    //   ->toArray();

    // $items = Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))
    //   ->whereIn('pedido_id', $pedidos_id)
    //   ->with('proceso')
    //   ->groupBy('proceso_id')
    //   ->get()
    //   ->each(function ($i) {
    //     return $i->nombre = $i->proceso->proceso;
    //   });
  }

  private function segumiento_material($user, $pedidos)
  {
    // $pedidos_array = $pedidos
    //   ->where('cliente_id', $cli->id)
    //   ->pluck('id')
    //   ->toArray();

    // $items = Solicitud_material::select('material_id', DB::raw('sum(total) as totalData'))
    //   ->whereIn('pedido_id', $pedidos_array)
    //   ->with('material')
    //   ->groupBy('material_id')
    //   ->get()
    //   ->each(function ($i) {
    //     return $i->nombre = $i->material->descripcion;
    //   });
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
