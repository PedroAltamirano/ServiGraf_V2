<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaEducacion extends Model
{
  use HasFactory;

  protected $table = 'nomina_educacion';
  protected $fillable = [
    'empresa_id', 'nomina_id', 'nivel_educ', 'nombre_institucion', 'inicio', 'fin', 'titulo'
  ];
}
