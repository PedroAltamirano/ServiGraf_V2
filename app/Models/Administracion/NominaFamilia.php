<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NominaFamilia extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'nomina_familia';
  protected $fillable = [
    'empresa_id', 'nomina_id', 'relacion', 'nombre_fam', 'fecha_nacimiento_fam', 'ocupacion', 'telefono_fam', 'celular_fam'
  ];
}
