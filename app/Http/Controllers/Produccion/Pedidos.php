<?php
namespace App\Http\Controllers\Produccion;

use App\Security;

use App\Models\Produccion\Pedido;
use App\Models\Produccion\Tinta;
use App\Models\Produccion\Material;
use App\Models\Produccion\Pedido_servicio;
use App\Models\Produccion\Pedido_tintas;
use App\Models\Produccion\Solicitud_material;
use App\Models\Produccion\Abono;
use App\Models\Ventas\Cliente;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

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
    $this->middleware('auth');
  }

  /**
  * Show pedidos dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function show(){
    $pedidos = Pedido::incompletas();
    if(Security::hasRol(30, 1)){
      return view('Produccion/pedidos', compact('pedidos'));
    } else {
      $data = [
        'type'=>'danger',
        'title'=>'NO AUTORIZADO',
        'message'=>'No estás autorizado a realizar esta operación'
      ];
      return redirect('tablero')->with(['actionStatus' => json_encode($data)]);
    }
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(){
    if(Security::hasRol(30, 2)){
      $pedido = new Pedido();
      $data = [
      'path' => route('pedido.create'),
      'text' => 'Nuevo Pedido',
      'action' => 'Crear',
      'mod' => 0,
      ];
      return view('Produccion.pedido', compact('pedido'))->with($data);
    } else {
      $data = [
        'type'=>'danger',
        'title'=>'NO AUTORIZADO',
        'message'=>'No estás autorizado a realizar esta operación'
      ];
      return redirect('pedidos')->with(['actionStatus' => json_encode($data)]);
    }
  }

  // crear nuevo 
  public function store(Request $request){
    // dd($request);
    
    if(Security::hasRol(30, 2)){
      $messages = [
        'required' => 'El campo :attribute es requerido.',
        'max' => 'El campo :attribute debe ser menor a :max.',
        'min' => 'El campo :attribute debe ser mayor a :min.',
        'numeric' => 'El campo :attribute debe ser numerico',
        'boolean' => 'El campo :attribute debe ser booleano',
        'string' => 'El campo :attribute debe ser textual',
        'exists' => 'El campo :attribute debe existir',
      ];
      $validator = Validator::make($request->all(), Requests\StorePedidoImprentaPost::rules(), $messages);
      if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }

      $num = Pedido::where('empresa_id', Auth::user()->empresa_id)->orderBy('numero', 'desc')->first()->numero;
      $num += 1;
      $number = str_pad($num, 5, "0", STR_PAD_LEFT);
      $id = Auth::user()->empresa_id.'.'.$number;

      $model = new Pedido;
      $model->empresa_id = Auth::user()->empresa_id;
      $model->numero = $num;
      $model->usuario_id = Auth::id();
      $model->usuario_mod_id = Auth::id();
      $model->cliente_id = $request->cliente;
      $model->id = $id;
      $model->fecha_entrada = $request->inicio;
      $fecha_salida = date('Y-m-d', strtotime('+3 days', strtotime($request->inicio)));
      $model->fecha_salida = $fecha_salida;
      $model->prioridad = $request->prioridad;
      $model->estado = $request->estado;
      $model->cotizado = $request->cotizado;
      $model->detalle = $request->descripcion;
      $model->papel = $request->papel;
      $model->cantidad = $request->cantidad;
      $model->corte_alto = $request->corte_alto;
      $model->corte_ancho = $request->corte_ancho;
      $model->numerado_inicio = $request->numerado_inicio;
      $model->numerado_fin = $request->numerado_fin;
      $model->total_material = $request->totalMaterial;
      $model->total_pedido = $request->totalProcesos;
      $model->abono = $request->totalAbonos;
      $model->saldo = $request->totalSaldo;
      $model->notas = $request->notas;
      if($request->estado == 2){
        $model->usuario_cob_id = Auth::id();
        $model->fecha_cobro = date('Y-m-d');
      }
      $model->save();

      foreach($request->tinta_tiro as $ttiro){
        $tinta = new Pedido_tintas;
        $tinta->tinta_id = $ttiro;
        $tinta->pedido_id = $model->id;
        $tinta->lado = 1;
        $tinta->save();
      }
      foreach($request->tinta_retiro as $tretiro){
        $tinta = new Pedido_tintas;
        $tinta->tinta_id = $tretiro;
        $tinta->pedido_id = $model->id;
        $tinta->lado = 0;
        $tinta->save();
      }

      $matSize = sizeof($request->material['id']);
      for($i=0; $i<$matSize; $i++){
        $material = new Solicitud_material;
        $material->empresa_id = Auth::user()->empresa_id;
        $material->pedido_id = $model->id;
        $material->material_id = $request->material['id'][$i];
        $material->cantidad = $request->material['cantidad'][$i];
        $material->corte_alto = $request->material['corte_alt'][$i];
        $material->corte_ancho = $request->material['corte_anc'][$i];
        $material->tamanos = $request->material['tamanios'][$i];
        $material->proveedor_id = $request->material['proveedor'][$i];
        $material->factura = $request->material['factura'][$i];
        $material->total = $request->material['total'][$i];
        $material->save();
      }

      $proSize = sizeof($request->proceso['id']);
      for($i=0; $i<$proSize; $i++){
        $servicio = $request->proceso['id'][$i];
        $subservicio = null;
        if(strpos($servicio, '.') !== false){
          $serv = explode('.', $servicio);
          $servicio = $serv[0];
          $subservicio = $serv[1];
        }

        $proceso = new Pedido_servicio;
        $proceso->empresa_id = Auth::user()->empresa_id;
        $proceso->pedido_id = $model->id;
        $proceso->servicio_id = $servicio;
        $proceso->subservicio_id = $subservicio;
        $proceso->tiro = $request->proceso['tiro'][$i];
        $proceso->retiro = $request->proceso['retiro'][$i];
        $proceso->millares = $request->proceso['millar'][$i];
        $proceso->valor_unitario = $request->proceso['valor'][$i];
        $proceso->total = $request->proceso['total'][$i];
        $proceso->status = $request->proceso['terminado'][$i];
        $proceso->save();
      }

      $data = [
        'type'=>'success',
        'title'=>'Acción completada',
        'message'=>'El pedido se ha creado con éxito'
      ];
      return redirect()->route('pedido.edit', $model->numero)->with(['actionStatus' => json_encode($data)]);
    
    } else {
      $data = [
        'type'=>'danger',
        'title'=>'NO AUTORIZADO',
        'message'=>'No estás autorizado a realizar esta operación'
      ];
      return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
    }
  }
 
  //ver modificar 
  public function edit(Request $request, $data_id){
    if(Security::hasRol(30, 3)){
      $pedido = Pedido::where('empresa_id', Auth::user()->empresa_id)->where('numero', $data_id)->first();
      $data = [
        'path'=> route('pedido.update', $pedido->id),
        'text'=>'Modificar Pedido '.$data_id,
        'action'=>'Modificar',
        'mod' => 1,
        'pedido' => $pedido
      ];
      return view('Produccion.pedido')->with($data);
      // return session('current.perfil');
    } else {
      $data = [
        'type'=>'danger',
        'title'=>'NO AUTORIZADO',
        'message'=>'No estás autorizado a realizar esta operación'
      ];
      return redirect('')->with(['actionStatus' => json_encode($data)]);
    }
  }
  
  //modificar perfil
  public function update(Request $request, $data_id){
    if(Security::hasRol(30, 3)){
      $messages = [
        'required' => 'El campo :attribute es requerido.',
        'max' => 'El campo :attribute debe ser menor a :max.',
        'min' => 'El campo :attribute debe ser mayor a :min.',
        'numeric' => 'El campo :attribute debe ser numerico',
        'boolean' => 'El campo :attribute debe ser booleano',
        'string' => 'El campo :attribute debe ser textual',
        'exists' => 'El campo :attribute debe existir',
      ];
      $validator = Validator::make($request->all(), Requests\StorePedidoImprentaPost::rules(), $messages);
      if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }

      $model = Pedido::find($data_id);
      $model->usuario_mod_id = Auth::id();
      // $model->cliente_id = $request->cliente;
      $model->fecha_entrada = $request->inicio;
      $fecha_salida = date('Y-m-d', strtotime('+3 days', strtotime($request->inicio)));
      $model->fecha_salida = $fecha_salida;
      $model->prioridad = $request->prioridad;
      $model->estado = $request->estado;
      $model->cotizado = $request->cotizado;
      $model->detalle = $request->descripcion;
      $model->papel = $request->papel;
      $model->cantidad = $request->cantidad;
      $model->corte_alto = $request->corte_alto;
      $model->corte_ancho = $request->corte_ancho;
      $model->numerado_inicio = $request->numerado_inicio;
      $model->numerado_fin = $request->numerado_fin;
      $model->total_material = $request->totalMaterial;
      $model->total_pedido = $request->totalProcesos;
      $model->abono = $request->totalAbonos;
      $model->saldo = $request->totalSaldo;
      $model->notas = $request->notas;
      if($request->estado == 2){
        $model->usuario_cob_id = Auth::id();
        $model->fecha_cobro = date('Y-m-d');
      }
      $model->save();

      Pedido_tintas::where('pedido_id', $model->id)->delete();
      foreach($request->tinta_tiro as $ttiro){
        $tinta = new Pedido_tintas;
        $tinta->tinta_id = $ttiro;
        $tinta->pedido_id = $model->id;
        $tinta->lado = 1;
        $tinta->save();
      }
      foreach($request->tinta_retiro as $tretiro){
        $tinta = new Pedido_tintas;
        $tinta->tinta_id = $tretiro;
        $tinta->pedido_id = $model->id;
        $tinta->lado = 0;
        $tinta->save();
      }

      Solicitud_material::where('empresa_id', Auth::user()->empresa_id)->where('pedido_id', $model->id)->delete();
      $matSize = sizeof($request->material['id']);
      for($i=0; $i<$matSize; $i++){
        $material = new Solicitud_material;
        $material->empresa_id = Auth::user()->empresa_id;
        $material->pedido_id = $model->id;
        $material->material_id = $request->material['id'][$i];
        $material->cantidad = $request->material['cantidad'][$i];
        $material->corte_alto = $request->material['corte_alt'][$i];
        $material->corte_ancho = $request->material['corte_anc'][$i];
        $material->tamanos = $request->material['tamanios'][$i];
        $material->proveedor_id = $request->material['proveedor'][$i];
        $material->factura = $request->material['factura'][$i];
        $material->total = $request->material['total'][$i];
        $material->save();
      }

      Pedido_servicio::where('empresa_id', Auth::user()->empresa_id)->where('pedido_id', $model->id)->delete();
      $proSize = sizeof($request->proceso['id']);
      for($i=0; $i<$proSize; $i++){
        $servicio = $request->proceso['id'][$i];
        $subservicio = null;
        if(strpos($servicio, '.') !== false){
          $serv = explode('.', $servicio);
          $servicio = $serv[0];
          $subservicio = $serv[1];
        }

        $proceso = new Pedido_servicio;
        $proceso->empresa_id = Auth::user()->empresa_id;
        $proceso->pedido_id = $model->id;
        $proceso->servicio_id = $servicio;
        $proceso->subservicio_id = $subservicio;
        $proceso->tiro = $request->proceso['tiro'][$i];
        $proceso->retiro = $request->proceso['retiro'][$i];
        $proceso->millares = $request->proceso['millar'][$i];
        $proceso->valor_unitario = $request->proceso['valor'][$i];
        $proceso->total = $request->proceso['total'][$i];
        $proceso->status = $request->proceso['terminado'][$i];
        $proceso->save();
      }

      $data = [
        'type'=>'success',
        'title'=>'Acción completada',
        'message'=>'El pedido se ha modificado con éxito'
      ];
      return redirect()->route('pedido.edit', $model->numero)->with(['actionStatus' => json_encode($data)]);
    
    } else {
      $data = [
        'type'=>'danger',
        'title'=>'NO AUTORIZADO',
        'message'=>'No estás autorizado a realizar esta operación'
      ];
      return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
    }
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
    if(Security::hasRol(30, 1)){
      $data['data'] = Pedido::todos();
      return response()->json($data);
    } else {
      return response('Unauthorized.', 401);
    }
  }

}
