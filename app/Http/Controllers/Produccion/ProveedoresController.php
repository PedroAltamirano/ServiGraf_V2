<?php

namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Produccion\Proveedor;

use App\Http\Requests\Produccion\StoreProveedor;

class ProveedoresController extends Controller
{
  use SoftDeletes;

  public function store(StoreProveedor $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $validator['usuario_id'] = Auth::id();
    $proveedor = Proveedor::create($validator);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El proveedor se ha creado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }
}
