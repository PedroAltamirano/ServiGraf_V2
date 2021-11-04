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
use App\Http\Controllers\Produccion\ImprentaController;

use App\Models\Produccion\Abono;
use App\Models\Produccion\Pedido;
use App\Models\Sistema\DatosEmpresa;

use App\Http\Requests\Produccion\AbonoRequest;
use App\Http\Requests\Produccion\StorePedidoImprenta;
use App\Http\Requests\Produccion\UpdatePedidoImprenta;

class PedidosController extends Controller
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
    $user = Auth::user();
    $num = Pedido::where('empresa_id', $user->empresa_id)->orderBy('numero', 'desc')->first()->numero ?? (DatosEmpresa::where('empresa_id', $user->empresa_id)->first()->inicio - 1);

    $validator = $request->validated();
    $validator['numero'] = $num + 1;
    $validator['empresa_id'] = $user->empresa_id;
    $validator['usuario_id'] = $user->cedula;
    $validator['usuario_mod_id'] = $user->cedula;
    $fecha_salida = Carbon::create($validator['fecha_entrada'])->addDays(3)->format('Y-m-d');
    $validator['fecha_salida'] = $fecha_salida;
    if ($request->estado == 2) {
      $validator['usuario_cob_id'] = $user->cedula;
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

  /**
   * busca un pedido y redirecciona a edit, si no error
   */
  public function buscar(Request $request)
  {
    $pedido = Pedido::where('empresa_id', Auth::user()->empresa_id)->where('numero', $request->input('pedido_num'));
    if ($pedido->exists()) {
      $pedido = $pedido->first();
      return redirect()->route('pedido.edit', $pedido);
    } else {
      Alert::error('Oops!', 'Pedido no encontrado');
      return redirect()->back();
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
    $user = Auth::user();
    $validator = $request->validated();
    $validator['usuario_mod_id'] = $user->cedula;
    $fecha_salida = Carbon::create($validator['fecha_entrada'])->addDays(3)->format('Y-m-d');
    $validator['fecha_salida'] = $fecha_salida;
    if ($request->estado == 2) {
      $validator['usuario_cob_id'] = $user->cedula;
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
    $user = Auth::user();
    $num = Pedido::where('empresa_id', $user->empresa_id)->orderBy('numero', 'desc')->first()->numero;

    $new_pedido = $pedido->replicate();
    $new_pedido->numero = $num + 1;
    $new_pedido->usuario_id = $user->cedula;
    $new_pedido->usuario_mod_id = $user->cedula;
    $new_pedido->save();

    app(ImprentaController::class)->duplicateTintas($pedido, $new_pedido);
    app(ImprentaController::class)->duplicateSolicitudMaterial($pedido, $new_pedido);
    app(ImprentaController::class)->duplicateProcesos($pedido, $new_pedido);

    Alert::success('Acción completada', 'Pedido duplicado con éxito');
    return redirect()->route('pedido.edit', $new_pedido->id);
  }

  public function abonos(AbonoRequest $request, Pedido $pedido)
  {
    $validated = $request->validated();
    Abono::where('pedido_id', $pedido->id)->delete();

    $aboSize = sizeof($validated['abono_pago']);
    for ($i = 0; $i < $aboSize; $i++) {
      $model = new Abono;
      $model->pedido_id = $pedido->id;
      $model->usuario_id = Auth::id();
      $model->fecha = $validated['abono_fecha'][$i];
      $model->forma_pago = $validated['abono_pago'][$i];
      $model->valor = $validated['abono_valor'][$i];
      $model->save();
    }

    $model = Pedido::find($pedido->id);
    $model->abono = $validated['abono'];
    $model->saldo = $model->total_pedido - $validated['abono'];
    $model->save();

    Alert::success('Acción completada', 'Abono guardado con éxito');
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
