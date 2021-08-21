<?php
namespace App\Http\Controllers\Produccion;

use Auth;
use Carbon\Carbon;

use App\Models\Produccion\Pedido;
use App\Models\Produccion\Tinta;
use App\Models\Produccion\Material;
use App\Models\Produccion\Pedido_proceso;
use App\Models\Produccion\Pedido_tintas;
use App\Models\Produccion\Solicitud_material;
use App\Models\Produccion\Abono;
use App\Models\Ventas\Cliente;
use App\View\Components\modalPedido;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Produccion\StorePedidoImprenta;
use App\Http\Requests\Produccion\UpdatePedidoImprenta;

class Pedidos extends Controller
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
  * Show pedidos dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function show(){
    $pedidos = Pedido::incompletas();
    return view('Produccion/pedidos', compact('pedidos'));
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(){
    $pedido = new Pedido;
    $data = [
      'text' => 'Nuevo Pedido',
      'path' => route('pedido.create'),
      'method' => 'POST',
      'action' => 'Crear',
      'mod' => 0,
    ];
    return view('Produccion.pedido', compact('pedido'))->with($data);
  }

  // crear nuevo
  public function store(StorePedidoImprenta $request){
    $validator = $request->validated();
    $num = Pedido::where('empresa_id', Auth::user()->empresa_id)->orderBy('numero', 'desc')->first()->numero;
    $validator['numero'] = $num + 1;
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $validator['usuario_id'] = Auth::id();
    $validator['usuario_mod_id'] = Auth::id();
    $fecha_salida = Carbon::create($validator['fecha_entrada'])->addDays(3)->format('Y-m-d');
    $validator['fecha_salida'] = $fecha_salida;
    if($request->estado == 2){
      $validator['usuario_cob_id'] = Auth::id();
      $validator['fecha_cobro'] = date('Y-m-d');
    }
    $model = Pedido::create($validator);
    // dd($validator['proceso']);

    foreach($validator['tinta_tiro'] ?? [] as $ttiro){
      $tinta = new Pedido_tintas;
      $tinta->tinta_id = $ttiro;
      $tinta->pedido_id = $model->id;
      $tinta->lado = 1;
      $tinta->save();
    }
    foreach($validator['tinta_retiro'] ?? [] as $tretiro){
      $tinta = new Pedido_tintas;
      $tinta->tinta_id = $tretiro;
      $tinta->pedido_id = $model->id;
      $tinta->lado = 0;
      $tinta->save();
    }

    $matSize = sizeof($validator['material']['id'] ?? []);
    for($i=0; $i < $matSize; $i++){
      $material = new Solicitud_material;
      $material->empresa_id = Auth::user()->empresa_id;
      $material->pedido_id = $model->id;
      $material->material_id = $validator['material']['id'][$i];
      $material->cantidad = $validator['material']['cantidad'][$i];
      $material->corte_alto = $validator['material']['corte_alt'][$i];
      $material->corte_ancho = $validator['material']['corte_anc'][$i];
      $material->tamanos = $validator['material']['tamanios'][$i];
      $material->proveedor_id = $validator['material']['proveedor'][$i];
      $material->factura = $validator['material']['factura'][$i];
      $material->total = $validator['material']['total'][$i];
      $material->save();
    }

    $proSize = sizeof($validator['proceso']['id'] ?? []);
    for($i=0; $i < $proSize; $i++){
      $servicio = $validator['proceso']['id'][$i];
      $subservicio = null;
      if(strpos($servicio, '.') !== false){
        $serv = explode('.', $servicio);
        $servicio = $serv[0];
        $subservicio = $serv[1];
      }

      $proceso = new Pedido_proceso;
      $proceso->empresa_id = Auth::user()->empresa_id;
      $proceso->pedido_id = $model->id;
      $proceso->servicio_id = $servicio;
      $proceso->subservicio_id = $subservicio;
      $proceso->tiro = $validator['proceso']['tiro'][$i];
      $proceso->retiro = $validator['proceso']['retiro'][$i];
      $proceso->millares = $validator['proceso']['millar'][$i];
      $proceso->valor_unitario = $validator['proceso']['valor'][$i];
      $proceso->total = $validator['proceso']['total'][$i];
      $proceso->status = $validator['proceso']['terminado'][$i];
      $proceso->save();
    }

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El pedido se ha creado con éxito'
    ];
    return redirect()->route('pedido.edit', $model->id)->with(['actionStatus' => json_encode($data)]);
  }

  //ver modificar
  public function edit(Pedido $pedido){
    $data = [
      'text'=>'Modificar Pedido '.$pedido->numero,
      'path'=> route('pedido.update', $pedido->id),
      'method' => 'PUT',
      'action'=>'Modificar',
      'mod' => 1,
    ];
    return view('Produccion.pedido', compact('pedido'))->with($data);
  }

  //modificar perfil
  public function update(UpdatePedidoImprenta $request, Pedido $pedido){
    $validator = $request->validated();
    // dd($validator);
    $validator['usuario_mod_id'] = Auth::id();
    $fecha_salida = Carbon::create($validator['fecha_entrada'])->addDays(3)->format('Y-m-d');
    $validator['fecha_salida'] = $fecha_salida;
    if($request->estado == 2){
      $validator['usuario_cob_id'] = Auth::id();
      $validator['fecha_cobro'] = date('Y-m-d');
    }

    $pedido->update($validator);

    Pedido_tintas::where('pedido_id', $pedido->id)->delete();
    foreach($validator['tinta_tiro'] ?? [] as $ttiro){
      $tinta = new Pedido_tintas;
      $tinta->tinta_id = $ttiro;
      $tinta->pedido_id = $pedido->id;
      $tinta->lado = 1;
      $tinta->save();
    }
    foreach($validator['tinta_retiro'] ?? [] as $tretiro){
      $tinta = new Pedido_tintas;
      $tinta->tinta_id = $tretiro;
      $tinta->pedido_id = $pedido->id;
      $tinta->lado = 0;
      $tinta->save();
    }

    Solicitud_material::where('empresa_id', Auth::user()->empresa_id)->where('pedido_id', $pedido->id)->delete();
    $matSize = sizeof($validator['material']['id'] ?? []);
    for($i=0; $i<$matSize; $i++){
      $material = new Solicitud_material;
      $material->empresa_id = Auth::user()->empresa_id;
      $material->pedido_id = $pedido->id;
      $material->material_id = $validator['material']['id'][$i];
      $material->cantidad = $validator['material']['cantidad'][$i];
      $material->corte_alto = $validator['material']['corte_alt'][$i];
      $material->corte_ancho = $validator['material']['corte_anc'][$i];
      $material->tamanos = $validator['material']['tamanios'][$i];
      $material->proveedor_id = $validator['material']['proveedor'][$i];
      $material->factura = $validator['material']['factura'][$i];
      $material->total = $validator['material']['total'][$i];
      $material->save();
    }

    Pedido_proceso::where('empresa_id', Auth::user()->empresa_id)->where('pedido_id', $pedido->id)->delete();
    $proSize = sizeof($validator['proceso']['id'] ?? []);
    for($i=0; $i<$proSize; $i++){
      $servicio = $validator['proceso']['id'][$i];
      $subservicio = null;
      if(strpos($servicio, '.') !== false){
        $serv = explode('.', $servicio);
        $servicio = $serv[0];
        $subservicio = $serv[1];
      }

      $proceso = new Pedido_proceso;
      $proceso->empresa_id = Auth::user()->empresa_id;
      $proceso->pedido_id = $pedido->id;
      $proceso->servicio_id = $servicio;
      $proceso->subservicio_id = $subservicio;
      $proceso->tiro = $validator['proceso']['tiro'][$i];
      $proceso->retiro = $validator['proceso']['retiro'][$i];
      $proceso->millares = $validator['proceso']['millar'][$i];
      $proceso->valor_unitario = $validator['proceso']['valor'][$i];
      $proceso->total = $validator['proceso']['total'][$i];
      $proceso->status = $validator['proceso']['terminado'][$i];
      $proceso->save();
    }

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El pedido se ha modificado con éxito'
    ];
    return redirect()->route('pedido.edit', $pedido->id)->with(['actionStatus' => json_encode($data)]);
  }

  public function abonos(Request $request, $data_id){
    Abono::where('pedido_id', $data_id)->delete();
    $aboSize = sizeof($request->abono['pago']);
    for($i=0; $i<$aboSize; $i++){
      $model = new Abono;
      $model->pedido_id = $data_id;
      $model->usuario_id = Auth::id();
      $model->forma_pago = $request->abono['pago'][$i];
      $model->valor = $request->abono['valor'][$i];
      $model->save();
    }

    $model = Pedido::find($data_id);
    $model->abono = $request->totalAbonos;
    $model->saldo = $model->total_pedido - $request->totalAbonos;
    $model->save();

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El abono se ha creado con éxito'
    ];
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }

  //AJAX
  //get todos los perfiles
  public function get(){
    $data['data'] = Pedido::todos();
  }

  public function modal(Request $request){
    $pedido = Pedido::find($request->pedido_id);
    $method = 'PUT';
    return view('components.modalPedido', compact('pedido', 'method'));
  }

}
