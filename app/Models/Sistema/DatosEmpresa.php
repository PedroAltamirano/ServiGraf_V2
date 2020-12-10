<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class DatosEmpresa extends Model{
  protected $table = 'datos_empresas';

  protected $fillable = [
    'empresa_id', 'usuario_id_mod', 'nombre', 'representante', 'ruc', 'direccion', 'telefono', 'celular', 'web', 'correo', 'inicio', 'iva', 'cloud'
  ];
}
