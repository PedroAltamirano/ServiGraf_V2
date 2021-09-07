<?php

namespace App\Http\Controllers\Administracion;

use Exception;
use App\Helpers\Archivos;
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
use App\Models\Administracion\Dotacion;

use App\Http\Requests\Administracion\StoreNomina;
use App\Http\Requests\Administracion\UpdateNomina;
use App\Models\Administracion\NominaDocs;
use App\Models\Administracion\NominaDotacion;
use App\Models\Administracion\NominaEducacion;
use App\Models\Administracion\NominaFamilia;
use App\Models\Administracion\NominaReferencia;

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
    $dotacion = Dotacion::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->get();
    $data = [
      'text' => 'Nueva Nomina',
      'path' => route('nomina.store'),
      'method' => 'POST',
      'action' => 'Crear',
    ];
    return view('Administracion.nomina', compact('nomina', 'ccostos', 'horarios', 'dotacion'))->with($data);
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

        if (isset($validated['foto'])) {
          $foto_name = Archivos::storeImagen($nomina->cedula, $validated['foto'], 'usuarios');
          $nomina->foto = $foto_name;
          $nomina->save();
        }

        $this->manageDocumentos($validated, $nomina);
        $this->manageEducacion($validated, $nomina);
        $this->manageReferencias($validated, $nomina);
        $this->manageDotacion($validated, $nomina);
        $this->manageFamiliares($validated, $nomina);

        Alert::success('Acción completada', 'Nómina creada con éxito');
        return redirect()->route('nomina.edit', $nomina->cedula);
      }
    } catch (Exception $err) {
      Log::error($err);
      DB::rollBack();
      Alert::error('Oops!', 'Nómina no creada');
      return redirect()->back()->withInput($request->except(['foto']));
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
    $dotacion = Dotacion::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->get();
    $data = [
      'text' => 'Modificar Nomina',
      'path' => route('nomina.update', $nomina->cedula),
      'method' => 'PUT',
      'action' => 'Modificar',
    ];
    return view('Administracion.nomina', compact('nomina', 'ccostos', 'horarios', 'dotacion'))->with($data);
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

    DB::beginTransaction();
    try {
      if ($nomina->update($validated)) {
        DB::commit();

        if (isset($validated['foto'])) {
          $foto_name = Archivos::storeImagen($nomina->cedula, $validated['foto'], 'usuarios');
          $nomina->foto = $foto_name;
          $nomina->save();
        }

        $this->manageDocumentos($validated, $nomina);
        $this->manageEducacion($validated, $nomina);
        $this->manageReferencias($validated, $nomina);
        $this->manageDotacion($validated, $nomina);
        $this->manageFamiliares($validated, $nomina);

        Alert::success('Acción completada', 'Nómina modificada con éxito');
        return redirect()->back();
      }
    } catch (Exception $err) {
      Log::error($err);
      DB::rollBack();
      Alert::error('Oops!', 'Nómina no modificada');
      return redirect()->back();
    }
  }

  public function manageDocumentos($request, Nomina $nomina)
  {
    $documentos = $nomina->documentos;
    if ($documentos != null && $documentos->count()) {
      $nomina->documentos()->delete();
    }

    $request['empresa_id'] = Auth::user()->empresa_id;
    $request['nomina_id'] = $nomina->cedula;
    $model = NominaDocs::create($request);

    return 1;
  }

  public function manageEducacion($request, Nomina $nomina)
  {
    if (!isset($request['nivel_educ'])) {
      return 0;
    }

    $educacion = $nomina->educacion;
    if ($educacion != null && $educacion->count()) {
      $nomina->educacion()->delete();
    }

    for ($i = 0; $i < sizeof($request['nivel_educ']); $i++) {
      $model = new NominaEducacion();
      $model->empresa_id = Auth::user()->empresa_id;
      $model->nomina_id = $nomina->cedula;
      $model->nivel_educ = $request['nivel_educ'][$i];
      $model->nombre_institucion = $request['nombre_institucion'][$i];
      $model->inicio = $request['inicio'][$i];
      $model->fin = $request['fin'][$i];
      $model->titulo = $request['titulo'][$i];
      $model->save();
    }
    return 1;
  }

  public function manageReferencias($request, Nomina $nomina)
  {
    if (!isset($request['tipo_refer'])) {
      return 0;
    }

    $referencias = $nomina->referencias;
    if ($referencias != null && $referencias->count()) {
      $nomina->referencias()->delete();
    }

    for ($i = 0; $i < sizeof($request['tipo_refer']); $i++) {
      $model = new NominaReferencia();
      $model->empresa_id = Auth::user()->empresa_id;
      $model->nomina_id = $nomina->cedula;
      $model->tipo_refer = $request['tipo_refer'][$i];
      $model->empresa = $request['empresa'][$i];
      $model->contacto = $request['contacto'][$i];
      $model->telefono_refer = $request['telefono_refer'][$i];
      $model->afinidad = $request['afinidad'][$i];
      $model->inicio_labor_refer = $request['inicio_labor_refer'][$i];
      $model->fin_labor_refer = $request['fin_labor_refer'][$i];
      $model->cargo_refer = $request['cargo_refer'][$i];
      $model->razon_separacion = $request['razon_separacion'][$i];
      $model->save();
    }
    return 1;
  }

  public function manageDotacion($request, Nomina $nomina)
  {
    if (!isset($request['entrega'])) {
      return 0;
    }

    $dotacion = $nomina->dotacion;
    if ($dotacion != null && $dotacion->count()) {
      $nomina->dotacion()->delete();
    }

    for ($i = 0; $i < sizeof($request['entrega']); $i++) {
      $model = new NominaDotacion();
      $model->empresa_id = Auth::user()->empresa_id;
      $model->nomina_id = $nomina->cedula;
      $model->entrega = $request['entrega'][$i];
      $model->dotacion_id = $request['dotacion_id'][$i];
      $model->save();
    }
    return 1;
  }

  public function manageFamiliares($request, Nomina $nomina)
  {
    if (!isset($request['nombre_fam'])) {
      return 0;
    }

    $familiares = $nomina->familiares;
    if ($familiares != null && $familiares->count()) {
      $nomina->familiares()->delete();
    }

    for ($i = 0; $i < sizeof($request['nombre_fam']); $i++) {
      $model = new NominaFamilia;
      $model->empresa_id = Auth::user()->empresa_id;
      $model->nomina_id = $nomina->cedula;
      $model->relacion = $request['relacion'][$i];
      $model->nombre_fam = $request['nombre_fam'][$i];
      $model->fecha_nacimiento_fam = $request['fecha_nacimiento_fam'][$i];
      $model->ocupacion = $request['ocupacion'][$i] ?? null;
      $model->telefono_fam = $request['telefono_fam'][$i] ?? null;
      $model->celular_fam = $request['celular_fam'][$i] ?? null;
      $model->save();
    }

    return 1;
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
    } catch (Exception $err) {
      Log::error($err);
      DB::rollBack();
      Alert::error('Oops!', 'Nómina no eliminada');
      return redirect()->back();
    }
  }
}
