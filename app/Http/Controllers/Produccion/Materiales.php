<?php

namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;

use App\Models\Produccion\Tinta;
use App\Models\Produccion\Material;
use App\Models\Produccion\Categoria;

use App\Http\Requests\Produccion\StoreMaterial;
use App\Http\Requests\Produccion\UpdateMaterial;

class Materiales extends Controller
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
    $materiales = Material::where('empresa_id', Auth::user()->empresa_id)->get();
    $tintas = Tinta::where('empresa_id', Auth::user()->empresa_id)->get();
    $categorias = Categoria::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Produccion/materiales', compact('materiales', 'tintas', 'categorias'));
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(){
    $material = new Material;
    $categorias = Categoria::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Nuevo Material',
      'path' => route('material.create'),
      'method' => 'POST',
      'action' => 'Crear',
      'mod' => 0,
    ];
    return view('Produccion.material', compact('material', 'categorias'))->with($data);
  }

  // crear nuevo
  public function store(StoreMaterial $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $validator['color'] = $validator['color'] ?? 0;
    $validator['uv'] = $validator['uv'] ?? 0;
    $validator['plastificado'] = $validator['plastificado'] ?? 0;
    // dd($validator);

    $material = Material::create($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El pedido se ha creado con éxito'
    ];
    return redirect()->route('material.edit', $material->id)->with(['actionStatus' => json_encode($data)]);
  }

  //ver modificar
  public function edit(Material $material){
    $categorias = Categoria::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text'=>'Modificar Material',
      'path'=> route('material.update', $material->id),
      'method' => 'PUT',
      'action'=>'Modificar',
      'mod' => 1,
    ];
    return view('Produccion.material', compact('material', 'categorias'))->with($data);
  }

  //modificar perfil
  public function update(UpdateMaterial $request, Material $material){
    $validator = $request->validated();
    $validator['color'] = $validator['color'] ?? 0;
    $validator['uv'] = $validator['uv'] ?? 0;
    $validator['plastificado'] = $validator['plastificado'] ?? 0;
    // dd($validator);

    $material->update($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El pedido se ha modificado con éxito'
    ];
    return redirect()->route('material.edit', $material->id)->with(['actionStatus' => json_encode($data)]);
  }
}
