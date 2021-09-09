<?php

namespace App\Http\Controllers\Ventas;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Ventas\Plantilla;

use App\Http\Requests\Ventas\StorePlantilla;
use App\Http\Requests\Ventas\UpdatePlantilla;

class PlantillaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $plantillas = Plantilla::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Ventas.plantillas', compact('plantillas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $plantilla = new Plantilla();
    $data = [
      'text' => 'Nueva Plantilla',
      'path' => route('plantilla.store'),
      'method' => 'POST',
      'action' => 'Crear',
    ];
    return view('Ventas.plantilla', compact('plantilla'))->with($data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StorePlantilla $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['creador_id'] = Auth::id();
    $validated['evaluacion'] = $validated['evaluacion'] ?? 0;
    $validated['seguimiento'] = $validated['seguimiento'] ?? 0;

    DB::beginTransaction();
    try {
      if ($plantilla = Plantilla::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Plantilla creada con éxito');
        return redirect()->route('plantilla.edit', $plantilla);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::success('Acción completada', 'Plantilla no creada');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Ventas\Plantilla  $plantilla
   * @return \Illuminate\Http\Response
   */
  public function show(Plantilla $plantilla)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Ventas\Plantilla  $plantilla
   * @return \Illuminate\Http\Response
   */
  public function edit(Plantilla $plantilla)
  {
    $data = [
      'text' => 'Modificar Plantilla',
      'path' => route('plantilla.update', $plantilla->id),
      'method' => 'PUT',
      'action' => 'Modificar',
    ];
    return view('Ventas.plantilla', compact('plantilla'))->with($data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Ventas\Plantilla  $plantilla
   * @return \Illuminate\Http\Response
   */
  public function update(UpdatePlantilla $request, Plantilla $plantilla)
  {
    $validated = $request->validated();
    $validated['modificador_id'] = Auth::id();
    $validated['evaluacion'] = $validated['evaluacion'] ?? 0;
    $validated['seguimiento'] = $validated['seguimiento'] ?? 0;

    DB::beginTransaction();
    try {
      if ($plantilla->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Plantilla modificada con éxito');
        return redirect()->route('plantilla.edit', $plantilla);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::success('Acción completada', 'Plantilla no modificada');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Ventas\Plantilla  $plantilla
   * @return \Illuminate\Http\Response
   */
  public function destroy(Plantilla $plantilla)
  {
    DB::beginTransaction();
    try {
      if ($plantilla->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Plantilla eliminada con éxito');
        return redirect()->route('Plantilla');
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::success('Acción completada', 'Plantilla no eliminada');
      return redirect()->back();
    }
  }
}
