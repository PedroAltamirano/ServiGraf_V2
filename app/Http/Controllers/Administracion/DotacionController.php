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

use App\Models\Administracion\Dotacion;

use App\Http\Requests\Administracion\StoreDotacion;
use App\Http\Requests\Administracion\UpdateDotacion;

class DotacionController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  App\Http\Requests\Administracion\StoreDotacion $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreDotacion $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['status'] = $validated['status'] ?? 0;

    DB::beginTransaction();
    try {
      if ($dotacion = Dotacion::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Dotacion creada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Dotacion no creada');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  App\Http\Requests\Administracion\UpdateDotacion $request
   * @param  App\Models\Administracion\Dotacion $dotacion
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateDotacion $request, Dotacion $dotacion)
  {
    $validated = $request->validated();
    $validated['status'] = $validated['status'] ?? 0;

    DB::beginTransaction();
    try {
      if ($dotacion->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Dotacion modificada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Dotacion no modificada');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  App\Http\Requests\Administracion\UpdateDotacion $request
   * @param  App\Models\Administracion\Dotacion $dotacion
   * @return \Illuminate\Http\Response
   */
  public function delete(Dotacion $dotacion)
  {
    DB::beginTransaction();
    try {
      if ($dotacion->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Dotacion eliminada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Dotacion no eliminada');
      return redirect()->back()->withInput();
    }
  }
}
