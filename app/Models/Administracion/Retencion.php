<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retencion extends Model
{
  use SoftDeletes;

  protected $table = 'retenciones';

  protected $fillable = [
    'empresa_id', 'tipo', 'porcentaje', 'descripcion', 'status'
  ];
}
