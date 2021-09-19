<?php

namespace App\Http\Controllers\Usuarios;

use Exception;
use App\Security;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Usuarios\Modulo;
use App\Models\Usuarios\Perfil;
use App\Models\Usuarios\ModPerfRol;

use App\Http\Requests\Usuarios\StorePerfil;
use App\Http\Requests\Usuarios\UpdatePerfil;

class PerfilesController extends Controller
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
    return view('Usuarios.perfil', compact('modules', 'perfil', 'modPerf'))->with($data);
  }

  //crear nuevo perfil
  public function store(StorePerfil $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;

    DB::beginTransaction();
    try {
      if ($perfil = Perfil::create($validator)) {
        $this->manageModPerfRol($validator, $perfil);

        DB::commit();
        Alert::success('Acción completada', 'Perfil creado con éxito');
        return redirect()->route('perfil.modificar', $perfil->id);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Perfil no creado');
      return redirect()->back()->withInput();
    }
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

    return view('Usuarios.perfil', compact('modules', 'perfil', 'modPerf'))->with($data);
  }

  //modificar perfil
  public function update(UpdatePerfil $request, Perfil $perfil)
  {
    $validator = $request->validated();
    $validator['status'] = $validator['status'] ?? 0;

    DB::beginTransaction();
    try {
      if ($perfil->update($validator)) {
        $this->manageModPerfRol($validator, $perfil);

        DB::commit();
        Alert::success('Acción completada', 'Perfil modificado con éxito');
        return redirect()->route('perfil.modificar', $perfil->id);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Perfil no modificado');
      return redirect()->back()->withInput();
    }
  }

  public function manageModPerfRol($request, Perfil $model)
  {
    $relation = $model->modulos();
    if ($relation->count()) {
      $relation->delete();
    }

    if (!isset($request['mod'])) {
      return 0;
    }

    foreach ($request['mod'] as $key => $value) {
      $modPerfRol = new ModPerfRol;
      $modPerfRol->perfil_id = $model->id;
      $modPerfRol->modulo_id = $key;
      $modPerfRol->rol_id = count($value);
      $modPerfRol->save();
    }
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
