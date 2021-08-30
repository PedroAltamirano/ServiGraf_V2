<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaReferencia extends Model
{
  use HasFactory;

  protected $table = 'nomina_refer';
  protected $fillable = [
    'empresa_id', 'nomina_id', 'tipo_refer', 'empresa', 'contacto', 'telefono_refer', 'afinidad', 'inicio_labor_refer', 'fin_labor_refer', 'cargo_refer', 'razon_separacion'
  ];
}
