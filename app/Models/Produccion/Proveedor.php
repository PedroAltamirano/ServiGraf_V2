<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
  protected $table = 'proveedores';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'proveedor', 'telefono', 'direccion'
  ];

  protected $hidden = [
    'created_at', 'updated_at',
  ];
}
