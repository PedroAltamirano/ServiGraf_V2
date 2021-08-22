<?php

namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Produccion\Area;
use App\Http\Requests\Produccion\StoreArea;
use App\Http\Requests\Produccion\UpdateArea;

class AreasController extends Controller
{
  use SoftDeletes;

  //crear nueva area
  public function store(StoreArea $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $area = Area::create($validator);

    Alert::success('Acción completada', 'Área creada con éxito');
    return redirect()->back();
  }

  //modificar area
  public function update(UpdateArea $request, Area $area)
  {
    $validator = $request->validated();
    $area->update($validator);

    Alert::success('Acción completada', 'Área modificada con éxito');
    return redirect()->back();
  }

  public function delete(Area $area)
  {
    $area->delete();

    Alert::success('Acción completada', 'Área eliminada con éxito');
    return redirect()->back();
  }
}
