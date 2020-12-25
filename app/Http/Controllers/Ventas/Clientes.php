<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

use App\Models\Ventas\Contacto;
use App\Models\Ventas\Cliente_empresa;
use App\Models\Ventas\Cliente;

use App\Http\Requests\Ventas\StoreCliente;
use App\Http\Requests\Ventas\UpdateCliente;
use Facade\FlareClient\Http\Client;

class Clientes extends Controller
{
  public function store(StoreCliente $request){
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $ex = Cliente_empresa::where('ruc', $validator['ruc']);
    if($ex->exists()){
      $cli_empresa = $ex->first();
    } else {
      $cli_empresa = Cliente_empresa::create(['nombre'=>$validator['empresa'], 'ruc'=>$validator['ruc'], 'empresa_id'=>$validator['empresa_id'], ]);
    }

    $validator['usuario_id'] = Auth::id();
    $validator['cliente_empresa_id'] = $cli_empresa->id;
    $contacto = Contacto::create(Arr::except($validator, ['empresa', 'ruc', 'isCliente', 'seguimento']));

    if(isset($validator['isCliente'])){
      $validator['contacto_id'] = $contacto->id;
      $cliente = Cliente::create(Arr::only($validator, ['empresa_id', 'usuario_id', 'contacto_id', 'cliente_empresa_id', 'seguimento']));
    }

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El cliente se ha creado con éxito'
    ];
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }

  public function telefono() {
    $cli = Cliente::find($_POST['cliente_id']);
    $res = '';
    if ($cli->contacto->telefono){
      $res .= $cli->contacto->telefono;
      if($cli->contacto->celular){
        $res .= ' / ';
      }
    }
    if ($cli->contacto->celular){
      $res .= $cli->contacto->celular;
    }
    return response()->json($res);
  }
}
