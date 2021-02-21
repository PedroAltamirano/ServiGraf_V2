<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Retencion extends Model
{
  protected $table = 'retenciones';

  protected $fillable = [
    'empresa_id', 'tipo', 'porcentaje', 'descripcion'
  ];
}
