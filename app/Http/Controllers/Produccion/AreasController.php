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
    public function store(StoreArea $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $area = Area::create($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'La área se ha creado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }

  //modificar area
  public function update(UpdateArea $request, Area $area){
    $validator = $request->validated();
    $area->update($validator);

    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->back();
  }

  public function delete(Area $area){
    $area->delete();

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'La área se ha eliminado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }
}
