<?php

namespace App\Http\Controllers\Produccion;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Produccion\Categoria;

use App\Http\Requests\Produccion\StoreCategoria;
use App\Http\Requests\Produccion\UpdateCategoria;

class CategoriasController extends Controller
{
  // crear nuevo
  public function store(StoreCategoria $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;

    DB::beginTransaction();
    try {
      if ($categoria = Categoria::create($validator)) {
        DB::commit();
        Alert::success('Acción completada', 'Categoría creada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Categoría no creada');
      return redirect()->back()->withInput();
    }
  }

  // modificar categoria
  public function update(UpdateCategoria $request, Categoria $categoria)
  {
    $validator = $request->validated();

    DB::beginTransaction();
    try {
      if ($categoria->update($validator)) {
        DB::commit();
        Alert::success('Acción completada', 'Categoría modificada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Categoría no modificada');
      return redirect()->back()->withInput();
    }
  }

  // Eliminar categoria
  public function delete(Categoria $categoria)
  {
    DB::beginTransaction();
    try {
      if ($categoria->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Categoría eliminada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Categoría no eliminada');
      return redirect()->back()->withInput();
    }
  }
}
