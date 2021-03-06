<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
  protected $table = 'ivas';

  protected $fillable = [
    'empresa_id', 'porcentaje'
  ];
}
