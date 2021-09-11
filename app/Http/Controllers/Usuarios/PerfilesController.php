<?php

namespace App\Http\Controllers\Usuarios;

use Exception;
use App\Security;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Usuarios\Perfil;
use App\Models\Usuarios\Modulo;
use App\Models\Usuarios\ModPerfRol;

use App\Http\Requests\Usuarios\StorePerfil;
use App\Http\Requests\Usuarios\UpdatePerfil;

class PerfilesController extends Controller
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


  //vista todos los perfiles
  public function show()
  {
    return view('Usuarios/perfiles');
  }

  //vista nuevo perfil
  public function create()
  {
    $modules = Modulo::todos();
    $perfil = new Perfil;
    $modPerf = new Collection([]);
    $data = [
      'path' => route('perfil.nuevo'),
      'text' => 'Nuevo perfil',
      'action' => 'Crear',
      'method' => 'POST',
      // 'modules'=>json_decode($modules)
    ];
    return view('Usuarios/perfil', compact('modules', 'perfil', 'modPerf'))->with($data);
  }

  //crear nuevo perfil
  public function store(StorePerfil $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;

    DB::beginTransaction();
    try {
      if ($actividad = Actividad::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Actividad creada con éxito');
        return redirect()->route('actividad.edit', $actividad);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Actividad no creada');
      return redirect()->back()->withInput();
    }

    $perfil = Perfil::create($validator);

    ModPerfRol::where('perfil_id', $perfil->id)->delete();
    foreach ($validator['mod'] as $key => $value) {
      $modPerfRol = new ModPerfRol;
      $modPerfRol->perfil_id = $perfil->id;
      $modPerfRol->modulo_id = $key;
      $modPerfRol->rol_id = count($value);
      $modPerfRol->save();
    }

    Alert::success('Acción completada', 'Perfil creado con exito');
    return redirect()->route('perfil.modificar', $perfil->id);
  }

  //ver modificar perfil
  public function edit(Perfil $perfil)
  {
    $modules = Modulo::todos();
    $data = [
      'path' => route('perfil.modificar', $perfil->id),
      'text' => 'Modificar perfil',
      'action' => 'Modificar',
      'method' => 'PUT',
    ];

    $modPerf = $perfil->modulos;

    return view('Usuarios/perfil', compact('modules', 'perfil', 'modPerf'))->with($data);
  }

  //modificar perfil
  public function update(UpdatePerfil $request, Perfil $perfil)
  {
    $validator = $request->validated();
    $validator['status'] = $validator['status'] ?? 0;

    DB::beginTransaction();
    try {
      if ($actividad = Actividad::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Actividad creada con éxito');
        return redirect()->route('actividad.edit', $actividad);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Actividad no creada');
      return redirect()->back()->withInput();
    }

    $perfil->update($validator);

    ModPerfRol::where('perfil_id', $perfil->id)->delete();
    foreach ($validator['mod'] as $key => $value) {
      $modPerfRol = new ModPerfRol;
      $modPerfRol->perfil_id = $perfil->id;
      $modPerfRol->modulo_id = $key;
      $modPerfRol->rol_id = count($value);
      $modPerfRol->save();
    }

    Alert::success('Acción completada', 'Perfil modificado con exito');
    return redirect()->route('perfil.modificar', $perfil->id);
  }


  //AJAX
  //get todos los perfiles
  public function get()
  {
    if (Security::hasRol(71, 1)) {
      $data = Perfil::todos();
      return response()->json(array('data' => $data));
    } else {
      return response('Unauthorized.', 401);
    }
  }
}
