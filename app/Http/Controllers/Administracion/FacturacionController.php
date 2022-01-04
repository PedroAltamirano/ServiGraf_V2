<?php

namespace App\Http\Controllers\Administracion;

use App\Helpers\NumToWords;
use Exception;
use App\Security;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Ventas\Cliente;
use App\Models\Sistema\FactEmpr;
use App\Models\Produccion\Pedido;
use App\Models\Administracion\Iva;
use App\Models\Administracion\Factura;
use App\Models\Administracion\FactProd;
use App\Models\Administracion\Retencion;
use App\Models\Administracion\FacturaPedido;

use App\Http\Requests\Administracion\StoreFactura;
use App\Http\Requests\Administracion\UpdateFactura;

class FacturacionController extends Controller
{
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

  public function show()
  {
    $empresas = FactEmpr::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->get();
    return view('Administracion.facturas', compact('empresas'));
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $user = Auth::user();
    $factura = new Factura;

    $fact_num = (Factura::where('tipo', 1)->where('empresa_id', $user->empresa_id)->select('numero')->orderBy('numero', 'DESC')->first()->numero ?? 0) + 1;
    $inicio = FactEmpr::where('empresa_id', $user->empresa_id)->where('status', 1)->value('inicio');
    if ($fact_num < $inicio) {
      $fact_num = $inicio;
    }

    $empresas = FactEmpr::where('empresa_id', $user->empresa_id)->where('status', 1)->get();

    $utilidad = Security::hasModule('19');

    $iva_p = '12'; //DEBE BBENIR DE CADA EMPRESA DE FACTURACION
    $ivas = Iva::where('empresa_id', $user->empresa_id)->where('status', 1)->get();
    $ret_iva = Retencion::where('empresa_id', $user->empresa_id)->where('status', 1)->where('tipo', 1)->get();
    $ret_fnt = Retencion::where('empresa_id', $user->empresa_id)->where('status', 1)->where('tipo', 0)->get();
    $pedidos = Pedido::where('empresa_id', $user->empresa_id)->get();
    $old_pedidos = [];
    $data = [
      'text' => 'Nueva Factura',
      'path' => route('factura.create'),
      'method' => 'POST',
      'action' => 'Crear',
      'mod' => 0,
    ];
    return view('Administracion.factura', compact('factura', 'fact_num', 'empresas', 'utilidad', 'iva_p', 'ivas', 'ret_iva', 'ret_fnt', 'pedidos', 'old_pedidos'))->with($data);
  }

  // crear nuevo
  public function store(StoreFactura $request)
  {
    $user = Auth::user();
    $validator = $request->validated();
    $validator['empresa_id'] = $user->empresa_id;
    $validator['usuario_id'] = $user->cedula;

    DB::beginTransaction();
    try {
      if ($factura = Factura::create($validator)) {
        $this->manageProductos($validator, $factura);
        $this->managePedidos($validator, $factura);

        DB::commit();
        Alert::success('Acción completada', 'Factura creada con éxito');
        return redirect()->route('factura.edit', $factura);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Factura no creada');
      return redirect()->back()->withInput();
    }
  }

  //ver modificar
  public function edit(Factura $factura)
  {
    $user = Auth::user();
    $fact_num = $factura->numero;
    $empresas = FactEmpr::where('empresa_id', $user->empresa_id)->where('status', 1)->get();

    $utilidad = Security::hasModule('19');

    $iva_p = '12'; //DEBE SALIR DESDE EL SISTEMA
    $ivas = Iva::where('empresa_id', $user->empresa_id)->where('status', 1)->get();
    $ret_iva = Retencion::where('empresa_id', $user->empresa_id)->where('status', 1)->where('tipo', 1)->get();
    $ret_fnt = Retencion::where('empresa_id', $user->empresa_id)->where('status', 1)->where('tipo', 0)->get();

    $pedidos = Pedido::where('empresa_id', $user->empresa_id)->get();
    $old_pedidos = $factura->pedidos->map(function ($p) {
      return $p->id;
    })->toArray();

    $data = [
      'text' => 'Modificar Factura ',
      'path' => route('factura.update', $factura->id),
      'method' => 'PUT',
      'action' => 'Modificar',
    ];
    return view('Administracion.factura', compact('factura', 'fact_num', 'empresas', 'utilidad', 'iva_p', 'ivas', 'ret_iva', 'ret_fnt', 'pedidos', 'old_pedidos'))->with($data);
  }

  //modificar perfil
  public function update(UpdateFactura $request, Factura $factura)
  {
    $validator = $request->validated();

    DB::beginTransaction();
    try {
      if ($factura->update($validator)) {
        $this->manageProductos($validator, $factura);
        $this->managePedidos($validator, $factura);

        DB::commit();
        Alert::success('Acción completada', 'Factura modificada con éxito');
        return redirect()->route('factura.edit', $factura->id);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Factura no modificada');
      return redirect()->back()->withInput();
    }
  }

  private function manageProductos($request, Factura $model)
  {
    $relation = $model->productos();
    if ($relation->count()) {
      $relation->delete();
    }

    if (!isset($request['articulo_cantidad'])) {
      return 0;
    }

    $cnt = count($request['articulo_cantidad'] ?? []);
    for ($i = 0; $i < $cnt; $i++) {
      $prod = new FactProd();
      $prod->factura_id = $model->id;
      $prod->cantidad = $request['articulo_cantidad'][$i];
      $prod->detalle = $request['articulo_detalle'][$i];
      $prod->iva_id = $request['articulo_iva_id'][$i];
      $prod->valor_unitario = $request['articulo_valor_unitario'][$i];
      $prod->subtotal = $request['articulo_subtotal'][$i];
      $prod->save();
    }
  }

  private function managePedidos($request, Factura $model)
  {
    $relation = $model->pedidos_id();
    if ($relation->count()) {
      $relation->delete();
    }

    if (!isset($request['pedidos'])) {
      return 0;
    }

    foreach ($request['pedidos'] as $pedido) {
      FacturaPedido::create(['factura_id' => $model->id, 'pedido_id' => $pedido]);
    }
  }

  // AJAX
  public function getFacts(Request $request)
  {
    $data = Factura::select('numero', 'cliente_id', 'emision', 'tipo', 'estado', 'total_pagar', 'vencimiento', 'fecha_pago', 'id')
      ->where('empresa_id', Auth::user()->empresa_id)
      ->whereBetween('emision', [$request->fechaini, $request->fechafin])
      ->where('fact_emp_id', $request->empresa)
      ->where(function ($query) use ($request) {
        if ($request->cliente != 'none') {
          $query->where('cliente_id', $request->cliente);
        }
        if ($request->tipo != 'none') {
          $query->where('tipo', $request->tipo);
        }
        if ($request->estado != 'none') {
          $query->where('estado', $request->estado);
        }
      })
      ->get()
      ->each(function ($item, $key) {
        $c = $item->cliente->contacto;
        $item->cli = $c->nombre . ' ' . $c->apellido;
        if (isset($item->fecha_pago)) {
          $mora = new Carbon($item->fecha_pago);
          $item->mora = $mora->diffInDays($item->vencimiento);
        } else {
          $mora = Carbon::now();
          $item->mora = $mora->diffInDays($item->vencimiento);
        }
      });

    return response()->json(array('data' => $data));
  }

  public function print(Factura $factura)
  {
    $empresa = $factura->empresa;
    $cliente = $factura->cliente;

    $code = $empresa->ruc . ' ' . $empresa->caja . '-' . number_format($factura->numero);

    $date = new Carbon($factura->emision);
    $emision = $empresa->ciudad . '&emsp;';
    $emision .= $date->format('d / m / Y');

    $iva_p = $empresa->iva->porcentaje;
    $total = (new NumToWords)->numtowords($factura->total);

    if ($empresa->impresion) {
      return view('Administracion.A4', compact('factura', 'empresa', 'cliente', 'code', 'emision', 'iva_p', 'total'));
    } else {
      return view('Administracion.A5', compact('factura', 'empresa', 'cliente', 'code', 'emision', 'iva_p', 'total'));
    }
  }
}
