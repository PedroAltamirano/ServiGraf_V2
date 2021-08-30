<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaFamilia extends Model
{
  use HasFactory;

  protected $table = 'nomina_familia';
  protected $fillable = [
    'empresa_id', 'nomina_id', 'relacion', 'nombre_fam', 'fecha_nacimiento_fam', 'ocupacion', 'telefono_fam', 'celular_fam'
  ];
}
