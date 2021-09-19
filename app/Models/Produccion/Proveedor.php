<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
  use SoftDeletes;

  protected $table = 'proveedores';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'proveedor', 'telefono', 'direccion'
  ];

  protected $hidden = [
    'created_at', 'updated_at',
  ];
}
