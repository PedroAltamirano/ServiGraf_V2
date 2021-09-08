<?php

namespace App\Http\Controllers\Ventas;

use stdClass;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Ventas\Contacto;
use App\Models\Ventas\Cliente_empresa;
use App\Models\Ventas\Cliente;

use App\Http\Requests\Ventas\StoreContacto;
use App\Http\Requests\Ventas\UpdateContacto;

class ContactoController extends Controller
{
  use SoftDeletes;

  public function store(StoreContacto $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $ex = Cliente_empresa::where('ruc', $validator['ruc']);
    if ($ex->exists()) {
      $cli_empresa = $ex->first();
    } else {
      $cli_empresa = Cliente_empresa::create(['nombre' => $validator['empresa'], 'ruc' => $validator['ruc'], 'empresa_id' => $validator['empresa_id'],]);
    }

    $validator['usuario_id'] = Auth::id();
    $validator['cliente_empresa_id'] = $cli_empresa->id;
    $contacto = Contacto::create(Arr::except($validator, ['empresa', 'ruc', 'isCliente', 'seguimento']));
    $mssg = 'Contacto creado con éxito';

    if (isset($validator['isCliente'])) {
      $validator['contacto_id'] = $contacto->id;
      $cliente = Cliente::create(Arr::only($validator, ['empresa_id', 'usuario_id', 'contacto_id', 'cliente_empresa_id', 'seguimento']));
      $mssg = 'Cliente creado con éxito';
    }

    Alert::success('Acción completada', $mssg);
    return redirect()->back();
  }

  public function info(Request $request)
  {
    $contacto = Contacto::with(['empresa'])->find($request->contacto_id);
    $contacto->movil = $contacto->movil;

    return response()->json($contacto);
  }

  public function infoCliente(Request $request)
  {
    $cli = Cliente::find($request->cliente_id);
    // $cli = Cliente::find();
    $cont = $cli->contacto;
    $emp = $cli->empresa;

    $res = $cont->only(['movil', 'direccion']);
    $res += $emp->only('ruc');

    return response()->json($res);
  }
}
