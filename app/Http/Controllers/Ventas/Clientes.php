<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use App\Models\Ventas\Cliente;
use App\Http\Controllers\Controller;

class Clientes extends Controller
{

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
