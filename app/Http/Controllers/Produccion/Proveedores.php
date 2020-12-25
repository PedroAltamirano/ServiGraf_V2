<?php

namespace App\Http\Controllers\Produccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Produccion\Proveedor;

use App\Http\Requests\Produccion\StoreProveedor;

class Proveedores extends Controller
{
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
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }
}
