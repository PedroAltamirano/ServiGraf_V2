<?php
namespace App\Http\Controllers\Produccion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Produccion\Area;
use App\Models\Produccion\Proceso;

use App\Http\Requests\Produccion\StoreProceso;
use App\Http\Requests\Produccion\UpdateProceso;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procesos extends Controller
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
  public function show(){
    $areas = Area::where('empresa_id', Auth::user()->empresa_id)->orderBy('orden')->get();
    $procesos = Proceso::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Produccion/procesos', compact('areas', 'procesos'));
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(){
    $proceso = new Proceso;
    $areas = Area::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Nuevo Proceso',
      'path' => route('proceso.store'),
      'method' => 'POST',
      'action' => 'Crear',
    ];
    return view('Produccion.proceso', compact('proceso', 'areas'))->with($data);
  }

  // crear nuevo
  public function store(StoreProceso $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $proceso = Proceso::create($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El  se ha creado con éxito'
    ];
    return redirect()->route('proceso.edit', $proceso->id)->with(['actionStatus' => json_encode($data)]);
  }

  // Ver modificar
  public function edit(Proceso $proceso){
    $areas = Area::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text'=>'Modificar Proceso',
      'path'=> route('proceso.update', $proceso->id),
      'method' => 'PUT',
      'action'=>'Modificar',
    ];
    return view('Produccion.proceso', compact('proceso', 'areas'))->with($data);
  }

  // Modificar perfil
  public function update(UpdateProceso $request, Proceso $proceso){
    $validator = $request->validated();
    $validator['subprocesos'] = $validator['subprocesos'] ?? 0;
    $validator['seguimiento'] = $validator['seguimiento'] ?? 0;
    // dd($validator);

    $proceso->update($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El  se ha modificado con éxito'
    ];
    return redirect()->route('proceso.edit', $proceso->id)->with(['actionStatus' => json_encode($data)]);
  }
}
