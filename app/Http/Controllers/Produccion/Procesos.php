<?php
namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Produccion\Area;
use App\Models\Produccion\Servicio;
use App\Models\Produccion\Sub_servicio;

use App\Http\Controllers\Controller;

class Procesos extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
  }

  /**
  * Show pedidos dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function show(){
    $areas = Area::where('empresa_id', Auth::user()->empresa_id)->orderBy('orden')->get();
    $servicios = Servicio::where('empresa_id', Auth::user()->empresa_id)->get();
    $seg = $servicios->reject(function($servicio){return $servicio->seguimiento == 0;});
    $seg = $servicios->map(function($servicio){return $servicio->id;});
    $subservicios = Sub_servicio::whereIn('servicio_id', $seg)->get();
    return view('Produccion/procesos', compact('areas', 'servicios', 'subservicios'));
  }
}
