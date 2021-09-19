<?php

namespace App\Http\Controllers\Produccion;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Produccion\Tinta;

use App\Http\Requests\Produccion\StoreTinta;
use App\Http\Requests\Produccion\UpdateTinta;

class TintasController extends Controller
{
  // crear nuevo
  public function store(StoreTinta $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;

    DB::beginTransaction();
    try {
      if ($tinta = Tinta::create($validator)) {
        DB::commit();
        Alert::success('Acción completada', 'Tinta creada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Tinta no creada');
      return redirect()->back()->withInput();
    }
  }

  //modificar perfil
  public function update(UpdateTinta $request, Tinta $tinta)
  {
    $validator = $request->validated();

    DB::beginTransaction();
    try {
      if ($tinta->update($validator)) {
        DB::commit();
        Alert::success('Acción completada', 'Tinta modificada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Tinta no modificada');
      return redirect()->back()->withInput();
    }
  }
}
