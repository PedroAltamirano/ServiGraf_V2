<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\Nomina;
use App\Models\Sistema\CentroCostos;
use App\Models\Sistema\Horario;

use App\Http\Requests\Administracion\StoreNomina;
use App\Http\Requests\Administracion\UpdateNomina;

class NominaController extends Controller
{
  use SoftDeletes;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $nominas = Nomina::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Administracion.nominas', compact('nominas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $nomina = new Nomina();
    $ccostos = CentroCostos::where('empresa_id', Auth::user()->empresa_id)->get();
    $horarios = Horario::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Nueva Nomina',
      'path' => route('nomina.create'),
      'method' => 'POST',
      'action' => 'Crear',
    ];
    return view('Administracion.nomina', compact('nomina', 'ccostos', 'horarios'))->with($data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreNomina $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;

    DB::beginTransaction();
    try {
      if ($nomina = Nomina::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Nómina creada con éxito');
        return redirect()->route('nomina.update', $nomina->cedula);
      }
    } catch (\Exception $err) {
      Log::error($err);
      DB::rollBack();
      Alert::error('Oops!', 'Nómina no creada');
      return redirect()->back();
    }
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
  public function edit(Nomina $nomina)
  {
    $ccostos = CentroCostos::where('empresa_id', Auth::user()->empresa_id)->get();
    $horarios = Horario::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Modificar Nomina',
      'path' => route('nomina.update', $nomina->cedula),
      'method' => 'PUT',
      'action' => 'Modificar',
    ];
    return view('Administracion.nomina', compact('nomina', 'ccostos', 'horarios'))->with($data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateNomina $request, Nomina $nomina)
  {
    $validated = $request->validated();
    dd($validated);

    DB::beginTransaction();
    try {
      if ($nomina->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Nómina modificada con éxito');
        return redirect()->back();
      }
    } catch (\Exception $err) {
      Log::error($err);
      DB::rollBack();
      Alert::error('Oops!', 'Nómina no modificada');
      return redirect()->back();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Nomina $nomina)
  {
    DB::beginTransaction();
    try {
      if ($nomina->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Nómina eliminada con éxito');
        return redirect()->route('nomina');
      }
    } catch (\Exception $err) {
      Log::error($err);
      DB::rollBack();
      Alert::error('Oops!', 'Nómina no eliminada');
      return redirect()->back();
    }
  }
}
