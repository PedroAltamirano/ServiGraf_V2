<?php

namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Produccion\Categoria;

use App\Http\Requests\Produccion\StoreCategoria;
use App\Http\Requests\Produccion\UpdateCategoria;

class CategoriasController extends Controller
{
  use SoftDeletes;

  // crear nuevo
  public function store(StoreCategoria $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $categoria = Categoria::create($validator);

    Alert::success('Acción completada', 'Categoría creada con éxito');
    return redirect()->back();
  }

  //modificar perfil
  public function update(UpdateCategoria $request, Categoria $categoria)
  {
    $validator = $request->validated();
    $categoria->update($validator);

    Alert::success('Acción completada', 'Categoría modificada con éxito');
    return redirect()->back();
  }
}
