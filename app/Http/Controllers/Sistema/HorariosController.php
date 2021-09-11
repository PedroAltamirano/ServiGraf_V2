<?php

namespace App\Http\Controllers\Sistema;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\Horario;

use App\Http\Requests\Sistema\StoreHorario;
use App\Http\Requests\Sistema\UpdateHorario;

class HorariosController extends Controller
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
    $horarios = Horario::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Sistema.horarios', compact('horarios'));
  }

  // crear nuevo
  public function store(StoreHorario $request)
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

    $horario = Horario::create($validator);

    Alert::success('Acción completada', 'Horario creado con éxito');
    return redirect()->back();
  }

  //modificar perfil
  public function update(UpdateHorario $request, Horario $horario)
  {
    $validator = $request->validated();

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
      Alert::error('Oops!' 'Actividad no creada');
      return redirect()->back()->withInput();
    }

    $horario->update($validator);

    Alert::success('Acción completada', 'Horario modificado con éxito');
    return redirect()->back();
  }
}
