<?php

namespace App\Http\Controllers\Produccion;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Http\Controllers\Produccion\ImprentaController;

use App\Models\Produccion\Pedido;
use App\Models\Produccion\Tinta;
use App\Models\Produccion\Material;
use App\Models\Produccion\Pedido_proceso;
use App\Models\Produccion\Pedido_tintas;
use App\Models\Produccion\Solicitud_material;
use App\Models\Produccion\Abono;
use App\Models\Ventas\Cliente;
use App\View\Components\modalPedido;

use App\Http\Requests\Produccion\StorePedidoImprenta;
use App\Http\Requests\Produccion\UpdatePedidoImprenta;

class PedidosController extends Controller
{
  use SoftDeletes;

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
  public function show()
  {
    $pedidos = Pedido::incompletas();
    return view('Produccion/pedidos', compact('pedidos'));
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
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
  public function store(StorePedidoImprenta $request)
  {
    $num = Pedido::where('empresa_id', Auth::user()->empresa_id)->orderBy('numero', 'desc')->first()->numero;

    $validator = $request->validated();
    $validator['numero'] = $num + 1;
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $validator['usuario_id'] = Auth::id();
    $validator['usuario_mod_id'] = Auth::id();
    $fecha_salida = Carbon::create($validator['fecha_entrada'])->addDays(3)->format('Y-m-d');
    $validator['fecha_salida'] = $fecha_salida;
    if ($request->estado == 2) {
      $validator['usuario_cob_id'] = Auth::id();
      $validator['fecha_cobro'] = date('Y-m-d');
    }

    DB::beginTransaction();
    try {
      if ($pedido = Pedido::create($validator)) {
        app(ImprentaController::class)->manageTintas($validator, $pedido);
        app(ImprentaController::class)->manageSolicitudMaterial($validator, $pedido);
        app(ImprentaController::class)->manageProcesos($validator, $pedido);

        DB::commit();
        Alert::success('Acción completada', 'Pedido creado con éxito');
        return redirect()->route('pedido.edit', $pedido->id);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Pedido no creado');
      return redirect()->back()->withInput();
    }
  }

  //ver modificar
  public function edit(Pedido $pedido)
  {
    $data = [
      'text' => 'Modificar Pedido ' . $pedido->numero,
      'path' => route('pedido.update', $pedido->id),
      'method' => 'PUT',
      'action' => 'Modificar',
      'mod' => 1,
    ];
    return view('Produccion.pedido', compact('pedido'))->with($data);
  }

  //modificar perfil
  public function update(UpdatePedidoImprenta $request, Pedido $pedido)
  {
    $validator = $request->validated();
    $validator['usuario_mod_id'] = Auth::id();
    $fecha_salida = Carbon::create($validator['fecha_entrada'])->addDays(3)->format('Y-m-d');
    $validator['fecha_salida'] = $fecha_salida;
    if ($request->estado == 2) {
      $validator['usuario_cob_id'] = Auth::id();
      $validator['fecha_cobro'] = date('Y-m-d');
    }

    DB::beginTransaction();
    try {
      if ($pedido->update($validator)) {
        app(ImprentaController::class)->manageTintas($validator, $pedido);
        app(ImprentaController::class)->manageSolicitudMaterial($validator, $pedido);
        app(ImprentaController::class)->manageProcesos($validator, $pedido);

        DB::commit();
        Alert::success('Acción completada', 'Pedido modificado con éxito');
        return redirect()->route('pedido.edit', $pedido->id);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Pedido no modificado');
      return redirect()->back()->withInput();
    }
  }

  // duplicar perfil
  public function duplicate(Pedido $pedido)
  {
    $num = Pedido::where('empresa_id', Auth::user()->empresa_id)->orderBy('numero', 'desc')->first()->numero;

    $new_pedido = $pedido->replicate();
    $new_pedido->numero = $num + 1;
    $new_pedido->usuario_id = Auth::id();
    $new_pedido->usuario_mod_id = Auth::id();
    $new_pedido->save();

    app(ImprentaController::class)->duplicateTintas($pedido, $new_pedido);
    app(ImprentaController::class)->duplicateSolicitudMaterial($pedido, $new_pedido);
    app(ImprentaController::class)->duplicateProcesos($pedido, $new_pedido);

    Alert::success('Acción completada', 'Pedido duplicado con éxito');
    return redirect()->route('pedido.edit', $new_pedido->id);
  }

  public function abonos(Request $request, $data_id)
  {
    Abono::where('pedido_id', $data_id)->delete();
    $aboSize = sizeof($request->abono_pago);
    for ($i = 0; $i < $aboSize; $i++) {
      $model = new Abono;
      $model->pedido_id = $data_id;
      $model->usuario_id = Auth::id();
      $model->fecha = $request->abono_fecha[$i];
      $model->forma_pago = $request->abono_pago[$i];
      $model->valor = $request->abono_valor[$i];
      $model->save();
    }

    $model = Pedido::find($data_id);
    $model->abono = $request->totalAbonos;
    $model->saldo = $model->total_pedido - $request->totalAbonos;
    $model->save();

    Alert::success('Acción completada', 'Abono creado con éxito');
    return redirect()->back();
  }

  //AJAX
  //get todos los perfiles
  public function get()
  {
    $data['data'] = Pedido::todos();
  }

  public function modal(Pedido $pedido)
  {
    $data = [
      'pedido' => $pedido,
      'tintas' => $pedido->tintas_id,
      'materiales' => $pedido->material_id,
      'procesos' => $pedido->procesos_id,
    ];
    return response()->json($data);
  }
}
