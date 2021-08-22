<?php

namespace App\Http\Controllers\Produccion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Produccion\Area;
use App\Http\Requests\Produccion\StoreArea;
use App\Http\Requests\Produccion\UpdateArea;
use Illuminate\Database\Eloquent\SoftDeletes;

class Areas extends Controller
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
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }

  //modificar area
  public function update(UpdateArea $request, Area $area){
    $validator = $request->validated();
    $area->update($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'La área se ha modificado con éxito'
    ];
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }

  public function delete(Area $area){
    $area->delete();

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'La área se ha eliminado con éxito'
    ];
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }
}
