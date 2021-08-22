<?php

namespace App\Http\Controllers\Produccion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Produccion\StoreTinta;
use App\Http\Requests\Produccion\UpdateTinta;
use App\Models\Produccion\Tinta;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tintas extends Controller
{
  use SoftDeletes;

  // crear nuevo
  public function store(StoreTinta $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    // dd($validator);

    $tinta = Tinta::create($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El pedido se ha creado con éxito'
    ];
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }

  //modificar perfil
  public function update(UpdateTinta $request, Tinta $tinta){
    $validator = $request->validated();
    // dd($validator);

    $tinta->update($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El pedido se ha modificado con éxito'
    ];
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }
}
