<?php

namespace App\Http\Controllers\Ventas;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Ventas\Actividad;

use App\Http\Requests\Ventas\StoreActividad;
use App\Http\Requests\Ventas\UpdateActividad;
use App\Models\Ventas\Plantilla;

class ActividadController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $actividades = Actividad::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Ventas.actividades', compact('actividades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $actividad = new Actividad();
    $plantillas = Plantilla::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Nueva Actividad',
      'path' => route('actividad.store'),
      'method' => 'POST',
      'action' => 'Crear',
    ];
    return view('Ventas.actividad', compact('actividad', 'plantillas'))->with($data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreActividad $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['creador_id'] = Auth::id();
    $validated['evaluacion'] = $validated['evaluacion'] ?? 0;
    $validated['seguimiento'] = $validated['seguimiento'] ?? 0;

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

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Ventas\Actividad  $actividad
   * @return \Illuminate\Http\Response
   */
  public function show(Actividad $actividad)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Ventas\Actividad  $actividad
   * @return \Illuminate\Http\Response
   */
  public function edit(Actividad $actividad)
  {
    $plantillas = Plantilla::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Modificar Actividad',
      'path' => route('actividad.update', $actividad->id),
      'method' => 'PUT',
      'action' => 'Modificar',
    ];
    return view('Ventas.actividad', compact('actividad', 'plantillas'))->with($data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Ventas\Actividad  $actividad
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateActividad $request, Actividad $actividad)
  {
    $validated = $request->validated();
    $validated['modificador_id'] = Auth::id();
    $validated['evaluacion'] = $validated['evaluacion'] ?? 0;
    $validated['seguimiento'] = $validated['seguimiento'] ?? 0;

    DB::beginTransaction();
    try {
      if ($actividad->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Actividad modificada con éxito');
        return redirect()->route('actividad.edit', $actividad);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Actividad no modificada');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Ventas\Actividad  $actividad
   * @return \Illuminate\Http\Response
   */
  public function destroy(Actividad $actividad)
  {
    DB::beginTransaction();
    try {
      if ($actividad->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Actividad eliminada con éxito');
        return redirect()->route('actividad');
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Actividad no eliminada');
      return redirect()->back();
    }
  }
}
