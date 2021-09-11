<?php

namespace App\Http\Controllers\Administracion;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Libro_ref;

use App\HTTP\Requests\Administracion\StoreReferencia;
use App\HTTP\Requests\Administracion\UpdateReferencia;

class ReferenciaController extends Controller
{
  use SoftDeletes;

  /**
   * Store a newly created resource in storage.
   *
   * @param  App\Http\Requests\Administracion\StoreReferencia  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreReferencia $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['usuario_id'] = Auth::id();

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

    $libro_ref = Libro_ref::create($validated);

    Alert::success('Acción completada', 'Referencia creada con éxito');
    return redirect()->back();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  App\Http\Requests\Administracion\UpdateReferencia  $request
   * @param  App\Models\Administracion\Libro_ref  $libro
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateReferencia $request, Libro_ref $libro_ref)
  {
    $validated = $request->validated();

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

    $libro_ref->update($validated);

    Alert::success('Acción completada', 'Referencia modificada con éxito');
    return redirect()->back();
  }
}
