<?php
namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Produccion\Sub_servicio;
use App\Models\Produccion\Servicio;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Produccion\StoreSubservicio;
use App\Http\Requests\Produccion\UpdateSubservicio;

class Subservicios extends Controller
{
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
    $subservicio = new Sub_servicio;
    $servicios = Servicio::where('empresa_id', Auth::user()->empresa_id)->where('subprocesos', 1)->get();
    $data = [
      'text' => 'Nuevo Subservicio',
      'path' => route('subservicio.store'),
      'method' => 'POST',
      'action' => 'Crear',
    ];
    return view('Produccion/subservicio', compact('subservicio', 'servicios'))->with($data);
  }

  // crear nuevo
  public function store(StoreSubservicio $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $subservicio = Sub_servicio::create($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El  se ha creado con éxito'
    ];
    return redirect()->route('subservicio.edit', $subservicio->id)->with(['actionStatus' => json_encode($data)]);
  }

  //ver modificar
  public function edit(Sub_servicio $subservicio){
    $servicios = Servicio::where('empresa_id', Auth::user()->empresa_id)->where('subprocesos', 1)->get();
    $data = [
      'text'=>'Modificar Subservicio',
      'path'=> route('subservicio.update', $subservicio->id),
      'method' => 'PUT',
      'action'=>'Modificar',
    ];
    return view('Produccion.subservicio', compact('subservicio', 'servicios'))->with($data);
  }

  //modificar perfil
  public function update(UpdateSubservicio $request, Sub_servicio $subservicio){
    $validator = $request->validated();
    // dd($validator);

    $subservicio->update($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El  se ha modificado con éxito'
    ];
    return redirect()->route('subservicio.edit', $subservicio->id)->with(['actionStatus' => json_encode($data)]);
  }
}
