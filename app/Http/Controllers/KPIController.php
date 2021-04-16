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

class KPIController extends Controller
{
  // PRODUCCION
  public function kpi_facturado() {

    $title = 'Facturado';
    $value = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [date('Y-m-').'01', date('Y-m-d')])->sum('total');
    $icon = 'file-invoice-dollar';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_utilidad() {
    $facturas = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [date('Y-m-').'01', date('Y-m-d')]);
    $total_facturado = $facturas->sum('total');
    $pedidos = $facturas->with('pedidos')->get();
    $total_producido = $pedidos->map(function($f){return $f->pedidos->sum('total_pedido');})->sum();
    $total_cotizado = $pedidos->map(function($f){return $f->pedidos->sum('cotizado');})->sum();
    $value = strval($total_facturado-$total_producido).'/'.strval($total_cotizado-$total_producido);

    $title = 'Utilidades Facturado / Cotizado';
    $value = $value;
    $icon = 'file-invoice-dollar';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_cobrar() {

    $title = 'Por Cobrar';
    $value = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [date('Y-m-').'01', date('Y-m-d')])->where('estado', 1)->sum('total');
    $icon = 'file-invoice-dollar';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  // public function kpi_flujo_efectivo() {

  //     $title = 'Flujo de Efectivo';
  //     $value = '';
  //     $icon = 'file-invoice-dollar';
  //     $color = '';

  //   return response()->json($data, 200);
  //   return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  // }

  public function kpi_lob_facturacion() {
    $twoyears = new Carbon('-2 years');
    $prediccion = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [$twoyears, date('Y-m-d')])->select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(emision,'%m') as months"))->groupBy('months')->get()->avg('total');
    $actual = Factura::where('empresa_id', Auth::user()->empresa_id)->whereBetween('emision', [date('Y-m-').'01', date('Y-m-d')])->sum('total');
    $value = strval($actual).' / '.strval($prediccion);

    $title = 'Utilidad Actual / Predicha';
    $value = $value;
    $icon = 'file-invoice-dollar';
    $color = Functions::getColor($actual, $prediccion);

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_maquinas() {
    $servicios = Servicio::where('empresa_id', Auth::user()->empresa_id)->where('seguimiento', 1)->get()->map(function($s){return $s->id;})->toArray();
    $pedidos = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [date('Y-m-').'01', date('Y-m-d')])->get()->map(function($p){return $p->id;})->toArray();
    $value = Pedido_servicio::whereIn('pedido_id', $pedidos)->whereIn('servicio_id', $servicios)->sum('total');

    $title = 'Máquinas';
    $value = $value;
    $icon = 'cogs';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_ots() {
    $pedidos = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [date('Y-m-').'01', date('Y-m-d')])->count();
    $incompletos = Pedido_servicio::where([['empresa_id', '=', auth()->user()->empresa_id], ['status', '=', '0']])->select('pedido_id')->groupBy('pedido_id')->get()->count();
    $value = strval($pedidos - $incompletos).' / '.strval($incompletos);

    $title = 'Ots Terminadas / Incompletas';
    $value = $value;
    $icon = 'cogs';
    $color = 'primary';

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  public function kpi_lob_ots() {
    $lastmonth = new Carbon('last day of last month');
    $twoyears = new Carbon('first day of this month');
    $twoyears->subYear(2);
    $prediccion = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [$twoyears, $lastmonth])->select(DB::raw('sum(total_pedido) as total'), DB::raw("DATE_FORMAT(fecha_entrada,'%m') as months"))->groupBy('months')->get()->avg('total');
    $actual = Pedido::where('empresa_id', Auth::user()->empresa_id)->whereBetween('fecha_entrada', [date('Y-m-').'01', date('Y-m-d')])->sum('total_pedido');
    $value = strval($actual).' / '.strval($prediccion);

    $title = 'Producción Actual / Predicha';
    $value = $value;
    $icon = 'cogs';
    $color = Functions::getColor($actual, $prediccion);

    // return response()->json($data, 200);
    return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  }

  // public function kpi_() {

  //   $title = '';
  //   $value = '';
  //   $icon = '';
  //   $color = '';

  //   return response()->json($data, 200);
  //   return view('components.kpi', compact('title', 'value', 'icon', 'color'));
  // }
}
