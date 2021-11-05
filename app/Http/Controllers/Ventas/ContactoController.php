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
    $user = Auth::user();
    $validated = $request->validated();
    $validated['empresa_id'] = $user->empresa_id;
    $validated['usuario_id'] = $user->cedula;
    $validated['isCliente'] = $validated['isCliente'] ?? 0;
    $validated['seguimiento'] = $validated['seguimiento'] ?? 0;

    DB::beginTransaction();
    try {
      if ($contacto = Contacto::create(Arr::except($validated, ['empresa', 'ruc', 'isCliente', 'seguimiento']))) {

        $this->manageClient($validated, $contacto);

        DB::commit();
        Alert::success('Acción completada', 'Contacto creado con éxito');
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
    $validated['isCliente'] = $validated['isCliente'] ?? 0;
    $validated['seguimiento'] = $validated['seguimiento'] ?? 0;

    DB::beginTransaction();
    try {
      if ($contacto->update(Arr::except($validated, ['empresa', 'ruc', 'isCliente', 'seguimiento']))) {
        $mssg = 'Contacto modificado con éxito';

        $this->manageClient($validated, $contacto, 1);

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

  public function destroy(Contacto $contacto)
  {
    $empresa = $contacto->empresa;
    $contacto->cliente->delete();

    DB::beginTransaction();
    try {
      if ($contacto->delete()) {
        if ($empresa->contactos->count() < 1) {
          $empresa->delete();
        }

        DB::commit();
        Alert::success('Acción completada', 'Contacto eliminado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Contacto no eliminado');
      return redirect()->back();
    }
  }

  private function manageClient($request, Contacto $contacto, $update = 0)
  {
    $user = Auth::user();
    $empresa = Cliente_empresa::firstOrCreate(
      ['ruc' => $request['ruc']],
      ['nombre' => $request['empresa'], 'ruc' => $request['ruc'], 'empresa_id' => $user->empresa_id]
    );

    $request['cliente_empresa_id'] = $empresa->id;

    $request['nombre'] = $request['empresa'];
    if ($update) {
      $empresa->update(Arr::only($request, ['nombre', 'ruc']));
    }

    $contacto->cliente_empresa_id = $empresa->id;
    $contacto->save();

    if ($request['isCliente']) {
      $cliente = Cliente::withTrashed()->firstOrCreate(
        ['contacto_id' => $contacto->id],
        ['empresa_id' => $user->empresa_id, 'usuario_id' => $user->cedula, 'contacto_id' => $contacto->id, 'cliente_empresa_id' => $empresa->id, 'tipo_contribuyente' => $request['tipo_contribuyente'], 'seguimiento' => $request['seguimiento']]
      );
      if ($cliente->trashed()) {
        $cliente->restore();
      }
      $cliente->update(Arr::only($request, ['cliente_empresa_id', 'tipo_contribuyente', 'seguimiento']));
    } else {
      if ($cliente = $contacto->cliente) {
        $cliente->delete();
      }
    }

    return 0;
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
