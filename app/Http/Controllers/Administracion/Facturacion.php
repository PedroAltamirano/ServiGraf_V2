<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sistema\Empresa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Session;

use App\Security;
use App\Models\Administracion\Factura;
use App\Models\Administracion\Fact_prod;
use App\Models\Administracion\Iva;
use App\Models\Administracion\Retencion;
use App\Models\Ventas\Cliente;
use App\Models\Sistema\Fact_empr;

use App\Http\Requests\Administracion\StoreFactura;
use App\Http\Requests\Administracion\UpdateFactura;
use App\Models\Administracion\FacturaPedido;
use App\Models\Produccion\Pedido;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facturacion extends Controller
{
	use SoftDeletes;
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
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function show(){
    $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('cliente_empresa_id')->get();
    $empresas = Fact_empr::where('empresa_id', Auth::user()->empresa_id)->get();
		return view('Administracion.facturas', compact('clientes', 'empresas'));
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    $factura = new Factura;
    $fact_num = (Factura::where('tipo', 1)->where('empresa_id', Auth::user()->empresa_id)->select('numero')->orderBy('numero', 'DESC')->first()->numero ?? 0) + 1;
    $empresas = Fact_empr::where('empresa_id', Auth::user()->empresa_id)->get();

    $utilidad = Security::hasModule('19');
    $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('cliente_empresa_id')->get();

    $iva_p = '12'; //DEBE BBENIR DE CADA EMPRESA DE FACTURACION
    $ivas = Iva::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->get();
    $ret_iva = Retencion::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->where('tipo', 1)->get();
    $ret_fnt = Retencion::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->where('tipo', 0)->get();
    $pedidos = Pedido::where('empresa_id', Auth::user()->empresa_id)->get();
    $old_pedidos = [];
    $data = [
      'text' => 'Nueva Factura',
      'path' => route('factura.create'),
      'method' => 'POST',
      'action' => 'Crear',
      'mod' => 0,
    ];
    return view('Administracion.factura', compact('factura', 'fact_num', 'empresas', 'utilidad', 'clientes', 'iva_p', 'ivas', 'ret_iva', 'ret_fnt', 'pedidos', 'old_pedidos'))->with($data);
  }

  // crear nuevo
  public function store(StoreFactura $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $validator['usuario_id'] = Auth::id();
    $factura = Factura::create($validator);

    $size = sizeof($validator['articulo']['cantidad'] ?? []);
    for($i=0; $i < $size; $i++){
      $prod = new Fact_prod();
      $prod->factura_id = $factura->id;
      $prod->cantidad = $validator['articulo']['cantidad'][$i];
      $prod->detalle = $validator['articulo']['detalle'][$i];
      $prod->iva_id = $validator['articulo']['iva_id'][$i];
      $prod->valor_unitario = $validator['articulo']['valor_unitario'][$i];
      $prod->subtotal = $validator['articulo']['subtotal'][$i];
      $prod->save();
    }

    if(isset($validatos['pedidos'])){
      foreach($validatos['pedidos'] as $pedido){
        FacturaPedido::create(['factura_id' => $factura->id, 'pedido_id' => $pedido]);
      }
    }

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'La factura se ha creado con éxito'
    ];

    return redirect()->route('factura.edit', $factura)->with(['actionStatus' => json_encode($data)]);
  }

  //ver modificar
  public function edit(Factura $factura){
    $fact_num = $factura->numero;
    $empresas = Fact_empr::where('empresa_id', Auth::user()->empresa_id)->get();

    $utilidad = Security::hasModule('19');
    $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('cliente_empresa_id')->get();

    $iva_p = '12'; //DEBE SALIR DESDE EL SISTEMA
    $ivas = Iva::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->get();
    $ret_iva = Retencion::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->where('tipo', 1)->get();
    $ret_fnt = Retencion::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->where('tipo', 0)->get();

    $pedidos = Pedido::where('empresa_id', Auth::user()->empresa_id)->get();
    $old_pedidos = $factura->pedidos->map(function($p){return $p->id;})->toArray();

    $data = [
      'text'=>'Modificar Factura ',
      'path'=> route('factura.update', $factura->id),
      'method' => 'PUT',
      'action' => 'Modificar',
    ];
    return view('Administracion.factura', compact('factura', 'fact_num', 'empresas', 'utilidad', 'clientes', 'iva_p', 'ivas', 'ret_iva', 'ret_fnt', 'pedidos', 'old_pedidos'))->with($data);
  }

  //modificar perfil
  public function update(UpdateFactura $request, Factura $factura){
    $validator = $request->validated();
    $factura->update($validator);

    Fact_prod::where('factura_id', $factura->id)->delete();
    $size = sizeof($validator['articulo']['cantidad'] ?? []);
    for($i=0; $i < $size; $i++){
      $prod = new Fact_prod();
      $prod->factura_id = $factura->id;
      $prod->cantidad = $validator['articulo']['cantidad'][$i];
      $prod->detalle = $validator['articulo']['detalle'][$i];
      $prod->iva_id = $validator['articulo']['iva_id'][$i];
      $prod->valor_unitario = $validator['articulo']['valor_unitario'][$i];
      $prod->subtotal = $validator['articulo']['subtotal'][$i];
      $prod->save();
    }

    FacturaPedido::where('factura_id', $factura->id)->delete();
    if(isset($validator['pedidos'])){
      foreach($validator['pedidos'] as $pedido){
        FacturaPedido::create(['factura_id' => $factura->id, 'pedido_id' => $pedido]);
      }
    }

    $data = [
      'type' => 'success',
      'title' => 'Acción completada',
      'message' => 'La factura se ha modificado con éxito'
    ];
    return redirect()->route('factura.edit', $factura->id)->with(['actionStatus' => json_encode($data)]);
  }

  // AJAX
	public function getFacts(Request $request){
    $data = Factura::select('numero', 'cliente_id', 'emision', 'tipo', 'estado', 'total_pagar', 'vencimiento', 'fecha_pago', 'id')
      ->where('empresa_id', Auth::user()->empresa_id)
      ->whereBetween('emision', [$request->fechaini, $request->fechafin])
      ->where('fact_emp_id', $request->empresa)
      ->where(function($query) use($request){
        if($request->cliente != 'none'){
          $query->where('cliente_id', $request->cliente);
        }
        if($request->tipo != 'none'){
          $query->where('tipo', $request->tipo);
        }
        if($request->estado != 'none'){
          $query->where('estado', $request->estado);
        }
      })
      ->get()
      ->each(function($item, $key){
        $c = $item->cliente->contacto;
        $item->cli = $c->nombre.' '.$c->apellido;
        if(isset($item->fecha_pago)){
          $mora = new Carbon($item->fecha_pago);
          $item->mora = $mora->diffInDays($item->vencimiento);
        } else {
          $mora = Carbon::now();
          $item->mora = $mora->diffInDays($item->vencimiento);
        }
      });

		return response()->json(array('data' => $data));
	}
}
