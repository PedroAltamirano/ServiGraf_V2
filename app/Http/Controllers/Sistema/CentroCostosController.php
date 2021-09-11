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

use App\Models\Sistema\CentroCostos;

use App\Http\Requests\Sistema\StoreCentroCostos;
use App\Http\Requests\Sistema\UpdateCentroCostos;

class CentroCostosController extends Controller
{
  use SoftDeletes;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreCentroCostos $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;

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
      Alert::success('Acción completada', 'Actividad no creada');
      return redirect()->back()->withInput();
    }

    $user = CentroCostos::create($validated);

    Alert::success('Acción completada', 'Centro de costos creado con éxito');
    return redirect()->back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCentroCostos $request, CentroCostos $centro)
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

    $centro->update($validated);

    Alert::success('Acción completada', 'Centro de costos modificado con éxito');
    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
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
  }
}
