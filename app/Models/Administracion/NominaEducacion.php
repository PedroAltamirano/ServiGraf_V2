<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NominaEducacion extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'nomina_educacion';
  protected $fillable = [
    'empresa_id', 'nomina_id', 'nivel_educ', 'nombre_institucion', 'inicio', 'fin', 'titulo'
  ];
}
