<?php

namespace App\Http\Controllers\Produccion;

use App\Models\Produccion\Area;
use App\Models\Produccion\Pedido;
use App\Models\Ventas\Cliente;

use App\Security;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class Reportes extends Controller
{
  // use AuthenticatesUsers;
  /**
   * Create a new controller instance.
  *
  * @return void
  */
  // public function __construct()
  // {
  //   $this->middleware('auth');
  // }

  public function showPedidos(){
    if(Security::hasRol(32, 1)){
      $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();
      $areas = Area::orderBy('orden')->get();
      return view('Produccion.reportePedidos', compact('areas', 'clientes'));
    } else {
      $data = [
        'type'=>'danger',
        'title'=>'NO AUTORIZADO',
        'message'=>'No estás autorizado a realizar esta operación'
      ];
      return redirect('tablero')->with(['actionStatus' => json_encode($data)]);
    } 
  }
  
  public static function ajaxPedidos(){
    $pedidos = Pedido::select('cliente_id', 'numero', 'id', 'detalle', 'total_pedido', 'abono', 'saldo', 'estado')->whereBetween('fecha_entrada', [date('Y-m-').'01', date('Y-m-d')])->get();
    foreach($pedidos as $pedido){
      $pedido->areas = Pedido::reporteAreas($pedido->id);
    }
    return response()->json($pedidos, 200);
  }
}
