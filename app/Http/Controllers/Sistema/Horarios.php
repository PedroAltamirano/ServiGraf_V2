<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Sistema\Horario;
use App\Http\Requests\Sistema\StoreHorario;
use App\Http\Requests\Sistema\UpdateHorario;

class Horarios extends Controller
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
  * Show pedidos dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function show(){
    $horarios = Horario::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Sistema.horarios', compact('horarios'));
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(){
    $horario = new Horario;
    $data = [
      'text' => 'Nuevo Horario',
      'path' => route('horario.create'),
      'method' => 'POST',
      'action' => 'Crear',
      'mod' => 0,
    ];
    return view('Sistema.horario', compact('horario'))->with($data);
  }

  // crear nuevo
  public function store(StoreHorario $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $horario = Horario::create($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El horario se ha creado con éxito'
    ];
    return redirect()->route('horario.edit', $horario->id)->with(['actionStatus' => json_encode($data)]);
  }

  //ver modificar
  public function edit(Horario $horario){
    $data = [
      'text'=>'Modificar Horario',
      'path'=> route('horario.update', $horario->id),
      'method' => 'PUT',
      'action'=>'Modificar',
      'mod' => 1,
    ];
    return view('Sistema.horario', compact('horario', 'categorias'))->with($data);
  }

  //modificar perfil
  public function update(UpdateHorario $request, Horario $horario){
    $validator = $request->validated();
    $horario->update($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El horario se ha modificado con éxito'
    ];
    return redirect()->route('horario.edit', $horario->id)->with(['actionStatus' => json_encode($data)]);
  }
}
