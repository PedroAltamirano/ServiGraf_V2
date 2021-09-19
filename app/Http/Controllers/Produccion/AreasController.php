<?php

namespace App\Http\Controllers\Produccion;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Produccion\Area;

use App\Http\Requests\Produccion\StoreArea;
use App\Http\Requests\Produccion\UpdateArea;

class AreasController extends Controller
{
  //crear nueva area
  public function store(StoreArea $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;

    DB::beginTransaction();
    try {
      if ($area = Area::create($validator)) {
        DB::commit();
        Alert::success('Acción completada', 'Área creada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Área no creada');
      return redirect()->back()->withInput();
    }
  }

  //modificar area
  public function update(UpdateArea $request, Area $area)
  {
    $validator = $request->validated();

    DB::beginTransaction();
    try {
      if ($area->update($validator)) {
        DB::commit();
        Alert::success('Acción completada', 'Área modificada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Área no modificada');
      return redirect()->back()->withInput();
    }
  }

  public function delete(Area $area)
  {
    DB::beginTransaction();
    try {
      if ($area->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Área eliminada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Área no eliminada');
      return redirect()->back();
    }
  }
}
