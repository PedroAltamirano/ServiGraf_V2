<?php

namespace App\Http\Controllers\Usuarios;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Ventas\Cliente;
use App\Models\Sistema\Nomina;
use App\Models\Usuarios\Perfil;
use App\Models\Usuarios\Usuario;
use App\Models\Produccion\Proceso;
use App\Models\Usuarios\UsuarioProceso;
use App\Models\Usuarios\UsuarioClientes;

use App\Http\Requests\Usuarios\Store;
use App\Http\Requests\Usuarios\Update;

class UsuariosController extends Controller
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
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */

  //ver todos los usuarios
  public function show()
  {
    return view('Usuarios/usuarios');
  }

  //crear usuario view
  public function create()
  {
    $usuario = new Usuario;
    $nomina = Nomina::availables();
    $perfiles = Perfil::where('empresa_id', Auth::user()->empresa_id)->select('id', 'nombre')->get();
    $procesos = Proceso::where('empresa_id', Auth::user()->empresa_id)->where('seguimiento', 1)->get();
    $actividades = [];
    $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('cliente_empresa_id')->where('seguimiento', 1)->get();
    $data = [
      'path' => route('usuario.store'),
      'text' => 'Nuevo usuario',
      'action' => 'Crear',
      'method' => 'POST'
    ];

    return view('Usuarios/usuario', compact('usuario', 'nomina', 'perfiles', 'procesos', 'actividades', 'clientes'))->with($data);
  }

  //crear nuevo
  public function store(Store $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $validator['password'] = Hash::make($request->password);

    DB::beginTransaction();
    try {
      if ($usuario = Usuario::create($validator)) {
        $this->manageProcesos($validator, $usuario);
        $this->manageClientes($validator, $usuario);

        DB::commit();
        Alert::success('Acción completada', 'Usuario creado con éxito');
        return redirect()->route('usuario.edit', $usuario->cedula);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Usuario no creado');
      return redirect()->back()->withInput();
    }
  }

  //ver modificar usuario
  public function edit(Usuario $usuario)
  {
    $nomina = Nomina::todos();
    $perfiles = Perfil::where('empresa_id', Auth::user()->empresa_id)->select('id', 'nombre')->get();
    $procesos = Proceso::where('empresa_id', Auth::user()->empresa_id)->where('seguimiento', 1)->get();
    $actividades = [];
    $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('cliente_empresa_id')->where('seguimiento', 1)->get();
    $data = [
      'path' => route('usuario.update', $usuario->cedula),
      'text' => 'Modificar usuario',
      'action' => 'Modificar',
      'method' => 'PUT'
    ];

    return view('Usuarios/usuario', compact('usuario', 'nomina', 'perfiles', 'procesos', 'actividades', 'clientes'))->with($data);
  }

  //modificar perfil
  public function update(Update $request, Usuario $usuario)
  {
    $validator = $request->validated();
    $validator['reservarot'] = $validator['reservarot'] ?? 0;
    $validator['libro'] = $validator['libro'] ?? 0;

    DB::beginTransaction();
    try {
      if ($usuario->update($validator)) {
        $this->manageProcesos($validator, $usuario);
        $this->manageClientes($validator, $usuario);

        DB::commit();
        Alert::success('Acción completada', 'Usuario modificado con éxito');
        return redirect()->route('usuario.edit', $usuario->cedula);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Usuario no modificado');
      return redirect()->back()->withInput();
    }
  }

  public function manageProcesos($request, Usuario $model)
  {
    $relation = $model->procesos_id();
    if ($relation->count()) {
      $relation->delete();
    }

    if (!isset($request['procesos'])) {
      return 0;
    }

    foreach ($request['procesos'] ?? [] as $pro) {
      $new = new UsuarioProceso;
      $new->usuario_id = Auth::id();
      $new->proceso_id = $pro;
      $new->save();
    }
  }

  public function manageClientes($request, Usuario $model)
  {
    $relation = $model->clientes_id();
    if ($relation->count()) {
      $relation->delete();
    }

    if (!isset($request['clientes'])) {
      return 0;
    }

    foreach ($request['clientes'] ?? [] as $cli) {
      $new = new UsuarioClientes;
      $new->usuario_id = Auth::id();
      $new->cliente_id = $cli;
      $new->save();
    }
  }


  //AJAX
  //get todos los perfiles
  public function get()
  {
    $data['data'] = Usuario::join('nomina as N', 'N.cedula', '=', 'usuarios.cedula')
      ->where('N.empresa_id', Auth::user()->empresa_id)
      ->select(['usuarios.cedula', 'usuarios.status', 'perfil' => Perfil::select('nombre as perfil')->whereColumn('id', 'usuarios.perfil_id'), 'N.nombre', 'N.apellido'])
      ->get();
    // echo json_encode($data);
    return response()->json($data);
  }
}
