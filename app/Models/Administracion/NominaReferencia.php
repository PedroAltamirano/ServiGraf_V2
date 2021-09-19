<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NominaReferencia extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'nomina_refer';
  protected $fillable = [
    'empresa_id', 'nomina_id', 'tipo_refer', 'empresa', 'contacto', 'telefono_refer', 'afinidad', 'inicio_labor_refer', 'fin_labor_refer', 'cargo_refer', 'razon_separacion'
  ];
}
