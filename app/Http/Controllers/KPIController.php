<?php

namespace App\Http\Controllers;

use App\Models\Administracion\Factura;
use Illuminate\Http\Request;
use App\Helpers\Functions;
use App\Models\Produccion\Pedido;
use App\Models\Produccion\Pedido_servicio;
use App\Models\Produccion\Servicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KPIController extends Controller
{
  // PRODUCCION
  public function kpi_facturado(Request $request) {
    $date = $request->get('fecha');
    $dateInit = date('Y-m-01', strtotime($date));
    $dateFin = date('Y-m-t', strtotime($date));

    $title = 'Facturado';
    $value = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [$dateInit, $dateFin])->sum('total');
    $icon = 'fa-file-invoice-dollar';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_utilidad(Request $request) {
    $date = $request->get('fecha');
    $dateInit = date('Y-m-01', strtotime($date));
    $dateFin = date('Y-m-t', strtotime($date));

    $facturas = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [$dateInit, $dateFin]);
    $total_facturado = $facturas->sum('total');
    $pedidos = $facturas->with('pedidos')->get();
    $total_producido = $pedidos->map(function($f){return $f->pedidos->sum('total_pedido');})->sum();
    $total_cotizado = $pedidos->map(function($f){return $f->pedidos->sum('cotizado');})->sum();
    $value = strval($total_facturado-$total_producido).' / '.strval($total_cotizado-$total_producido);

    $title = 'Utilidades Facturado / Cotizado';
    $value = $value;
    $icon = 'fa-file-invoice-dollar';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_cobrar(Request $request) {
    $date = $request->get('fecha');
    $dateInit = date('Y-m-01', strtotime($date));
    $dateFin = date('Y-m-t', strtotime($date));

    $title = 'Por Cobrar';
    $value = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [$dateInit, $dateFin])->where('estado', 1)->sum('total');
    $icon = 'fa-file-invoice-dollar';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  // public function kpi_flujo_efectivo(Request $request) {

  //     $title = 'Flujo de Efectivo';
  //     $value = '';
  //     $icon = 'fa-file-invoice-dollar';
  //     $color = '';

  //   return response()->json($data, 200);
  //   return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  // }

  public function kpi_lob_facturacion(Request $request) {
    $date = $request->get('fecha');
    $dateInit = date('Y-m-01', strtotime($date));
    $dateFin = date('Y-m-t', strtotime($date));

    $lastmonth = new Carbon($date);
    $lastmonth->subMonth()->endOfMonth();
    $twoyears = new Carbon($date);
    $twoyears->startOfMonth()->subYear(2);

    $prediccion = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [$twoyears, $lastmonth])->select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(emision,'%m') as months"))->groupBy('months')->get()->avg('total') ?? 0;
    $actual = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [$dateInit, $dateFin])->sum('total');
    $value = strval($actual).' / '.strval($prediccion);

    $title = 'Utilidad Actual / Predicha';
    $value = $value;
    $icon = 'fa-file-invoice-dollar';
    $color = Functions::getColor($actual, $prediccion);

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_maquinas(Request $request) {
    $date = $request->get('fecha');
    $dateInit = date('Y-m-01', strtotime($date));
    $dateFin = date('Y-m-t', strtotime($date));

    $servicios = Servicio::where('empresa_id', Auth::user()->empresa_id)->where('seguimiento', 1)->get()->map(function($s){return $s->id;})->toArray();
    $pedidos = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [$dateInit, $dateFin])->get()->map(function($p){return $p->id;})->toArray();
    $value = Pedido_servicio::whereIn('pedido_id', $pedidos)->whereIn('servicio_id', $servicios)->sum('total');

    $title = 'Máquinas';
    $value = $value;
    $icon = 'fa-cogs';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_ots(Request $request) {
    $date = $request->get('fecha');
    $dateInit = date('Y-m-01', strtotime($date));
    $dateFin = date('Y-m-t', strtotime($date));

    $pedidos = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [$dateInit, $dateFin])->count();
    $incompletos = Pedido_servicio::where([['empresa_id', '=', auth()->user()->empresa_id], ['status', '=', '0']])->select('pedido_id')->groupBy('pedido_id')->get()->count();
    $value = strval($pedidos - $incompletos).' / '.strval($incompletos);

    $title = 'Pedidos Terminados / Incompletos';
    $value = $value;
    $icon = 'fa-cogs';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_lob_ots(Request $request) {
    $date = $request->get('fecha');
    $dateInit = date('Y-m-01', strtotime($date));
    $dateFin = date('Y-m-t', strtotime($date));

    $lastmonth = new Carbon($date);
    $lastmonth->subMonth()->endOfMonth();
    $twoyears = new Carbon($date);
    $twoyears->startOfMonth()->subYear(2);

    $prediccion = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [$twoyears, $lastmonth])->select(DB::raw('sum(total_pedido) as total'), DB::raw("DATE_FORMAT(fecha_entrada,'%m') as months"))->groupBy('months')->get()->avg('total') ?? 0;
    $actual = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [$dateInit, $dateFin])->sum('total_pedido');
    $value = strval($actual).' / '.strval($prediccion);

    $title = 'Producción Actual / Predicha';
    $value = $value;
    $icon = 'fa-cogs';
    $color = Functions::getColor($actual, $prediccion);

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  // public function kpi_(Request $request) {

  //   $title = '';
  //   $value = '';
  //   $icon = '';
  //   $color = '';

  //   return response()->json($data, 200);
  //   return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  // }
}
