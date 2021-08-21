<?php
namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Produccion\Area;
use App\Models\Produccion\Proceso;

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
    $procesos = Proceso::where('empresa_id', Auth::user()->empresa_id)->get();
    $seg = $procesos->reject(function($servicio){return $servicio->seguimiento == 0;});
    $seg = $procesos->map(function($servicio){return $servicio->id;});
    return view('Produccion/procesos', compact('areas', 'procesos'));
  }
}
