<?php

namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Http\Requests\Produccion\StoreCategoria;
use App\Http\Requests\Produccion\UpdateCategoria;
use App\Models\Produccion\Categoria;

class CategoriasController extends Controller
{
  use SoftDeletes;

  // crear nuevo
  public function store(StoreCategoria $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $categoria = Categoria::create($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El pedido se ha creado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }

  //modificar perfil
  public function update(UpdateCategoria $request, Categoria $categoria){
    $validator = $request->validated();
    $categoria->update($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El pedido se ha modificado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }
}
