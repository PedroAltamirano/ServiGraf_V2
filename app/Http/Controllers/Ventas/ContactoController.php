<?php

namespace App\Http\Controllers\Ventas;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Ventas\CRM;
use App\Models\Ventas\Cliente;
use App\Models\Ventas\Contacto;
use App\Models\Ventas\Comentario;
use App\Models\Ventas\Cliente_empresa;

use App\Http\Requests\Ventas\StoreContacto;
use App\Http\Requests\Ventas\UpdateContacto;
use App\Models\Usuarios\Usuario;

class ContactoController extends Controller
{
  public function index()
  {
    $contactos = Contacto::where('empresa_id', Auth::user()->empresa_id)->with(['empresa', 'cliente'])->orderBy('cliente_empresa_id')->orderBy('nombre')->get();
    return view('Ventas.contactos', compact('contactos'));
  }

  public function create()
  {
    // $contacto = new Contacto();
    // $data = [
    //   'text' => 'Nuevo Contacto',
    //   'path' => route('contacto.store'),
    //   'method' => 'POST',
    //   'action' => 'Crear',
    // ];
    // return view('Ventas.contacto', compact('contacto'))->with($data);
  }

  public function store(StoreContacto $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $ex = Cliente_empresa::where('ruc', $validated['ruc']);
    if ($ex->exists()) {
      $cli_empresa = $ex->first();
    } else {
      $cli_empresa = Cliente_empresa::create(['nombre' => $validated['empresa'], 'ruc' => $validated['ruc'], 'empresa_id' => $validated['empresa_id'],]);
    }
    $validated['usuario_id'] = Auth::id();
    $validated['cliente_empresa_id'] = $cli_empresa->id;

    DB::beginTransaction();
    try {
      if ($contacto = Contacto::create(Arr::except($validated, ['empresa', 'ruc', 'isCliente', 'seguimento']))) {
        $mssg = 'Contacto creado con éxito';
        if (isset($validated['isCliente'])) {
          $validated['contacto_id'] = $contacto->id;
          $cliente = Cliente::create(Arr::only($validated, ['empresa_id', 'usuario_id', 'contacto_id', 'cliente_empresa_id', 'tipo_contribuyente', 'seguimiento']));
          $mssg = 'Cliente creado con éxito';
        }

        DB::commit();
        Alert::success('Acción completada', $mssg);
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Contacto no creado');
      return redirect()->back();
    }
  }

  public function show(Contacto $contacto)
  {
    $empresa = $contacto->empresa;
    $tareas = CRM::where('contacto_id', $contacto->id)->orderBy('fecha', 'desc')->with(['contacto', 'actividad', 'asignado'])->get();
    $comentarios = Comentario::where('contacto_id', $contacto->id)->orderBy('created_at', 'desc')->limit(50)->get()->toTree();
    return view('Ventas.contacto', compact('contacto', 'empresa', 'tareas', 'comentarios'));
  }

  public function edit(Contacto $contacto)
  {
    // $data = [
    //   'text' => 'Modificar Contacto',
    //   'path' => route('contacto.update', $contacto),
    //   'method' => 'PUT',
    //   'action' => 'Modificar',
    // ];
    // return view('Ventas.contacto', compact('contacto'))->with($data);
  }

  public function update(UpdateContacto $request, Contacto $contacto)
  {
    $validated = $request->validated();

    $ex = Cliente_empresa::where('ruc', $validated['ruc']);
    if ($ex->exists()) {
      $cli_empresa = $ex->first();
      $cli_empresa->update(Arr::only($validated, ['empresa', 'ruc']));
    }
    $validated['cliente_empresa_id'] = $cli_empresa->id;

    DB::beginTransaction();
    try {
      if ($contacto->update(Arr::except($validated, ['empresa', 'ruc', 'isCliente', 'seguimento']))) {
        $mssg = 'Contacto creado con éxito';
        $cliente = $contacto->cliente;
        if (isset($validated['isCliente'])) {
          $validated['contacto_id'] = $contacto->id;
          if ($cliente->count()) {
            $cliente->update(Arr::only($validated, ['cliente_empresa_id', 'tipo_contribuyente', 'seguimiento']));
            $mssg = 'Cliente modificado con éxito';
          } else {
            $cliente = Cliente::create(Arr::only($validated, ['empresa_id', 'usuario_id', 'contacto_id', 'cliente_empresa_id', 'tipo_contribuyente', 'seguimiento']));
            $mssg = 'Cliente creado con éxito';
          }
        } else {
          if ($cliente->count()) {
            $cliente->delete();
            $mssg = 'Cliente eliminado con éxito';
          }
        }

        DB::commit();
        Alert::success('Acción completada', $mssg);
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Contacto no modificado');
      return redirect()->back();
    }
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
