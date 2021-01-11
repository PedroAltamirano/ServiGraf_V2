<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sistema\Empresa;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Session;

use App\Models\Administracion\Factura;
use App\Models\Administracion\Fact_prod;
use App\Models\Administracion\Iva;
use App\Models\Ventas\Cliente;
use App\Models\Sistema\Fact_empr;

use App\Http\Requests\Administracion\StoreFactura;
use App\Http\Requests\Administracion\UpdateFactura;

class Facturacion extends Controller
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
    $empresas = Fact_empr::where('empresa_id', Auth::user()->empresa_id)->get();
    $iva = '12';
    $ivas = Iva::where('empresa_id', Auth::user()->empresa_id)->get();
    $ret_iva = Iva::where('empresa_id', Auth::user()->empresa_id)->get();
    $ret_fnt = Iva::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Nueva Factura',
      'path' => route('factura.create'),
      'method' => 'POST',
      'action' => 'Crear',
      'mod' => 0,
    ];
    return view('Administracion.factura', compact('factura', 'empresas', 'iva', 'ivas', 'ret_iva', 'ret_fnt'))->with($data);
  }

  // crear nuevo
  public function store(StoreFactura $request){
    $validator = $request->validated();

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'La factura se ha creado con éxito'
    ];

    return redirect()->route('factura.edit', $model->id)->with(['actionStatus' => json_encode($data)]);
  }

  //ver modificar
  public function edit(Factura $factura){
    $empresas = Fact_empr::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text'=>'Modificar Factura '.$factura->id,
      'path'=> route('factura.update', $factura->id),
      'method' => 'PUT',
      'action' => 'Modificar',
      'mod' => 1,
    ];
    return view('Administracion.factura', compact('factura', 'empresas'))->with($data);
  }

  //modificar perfil
  public function update(UpdateFactura $request, Factura $factura){
    $validator = $request->validated();
    $factura->update($validator);

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
