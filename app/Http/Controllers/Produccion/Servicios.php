<?php
namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Produccion\Servicio;
use App\Models\Produccion\Area;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Produccion\StoreServicio;
use App\Http\Requests\Produccion\UpdateServicio;

class Servicios extends Controller
{
  use AuthenticatesUsers;
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(){
    $servicio = new Servicio;
    $areas = Area::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Nuevo Servicio',
      'path' => route('servicio.store'),
      'method' => 'POST',
      'action' => 'Crear',
    ];
    return view('Produccion.servicio', compact('servicio', 'areas'))->with($data);
  }

  // // crear nuevo
  public function store(StoreServicio $request){
    $validator = $request->validated();
    // dd($validator);
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $servicio = Servicio::create($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El  se ha creado con éxito'
    ];
    return redirect()->route('servicio.edit', $servicio->id)->with(['actionStatus' => json_encode($data)]);
  }

  // //ver modificar
  public function edit(Servicio $servicio){
    $areas = Area::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text'=>'Modificar Servicio',
      'path'=> route('servicio.update', $servicio->id),
      'method' => 'PUT',
      'action'=>'Modificar',
    ];
    return view('Produccion.servicio', compact('servicio', 'areas'))->with($data);
  }

  // //modificar perfil
  public function update(UpdateServicio $request, Servicio $servicio){
    $validator = $request->validated();
    $validator['subprocesos'] = $validator['subprocesos'] ?? 0;
    $validator['seguimiento'] = $validator['seguimiento'] ?? 0;
    // dd($validator);

    $servicio->update($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El  se ha modificado con éxito'
    ];
    return redirect()->route('servicio.edit', $servicio->id)->with(['actionStatus' => json_encode($data)]);
  }
}
