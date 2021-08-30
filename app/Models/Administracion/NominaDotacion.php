<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaDotacion extends Model
{
  use HasFactory;

  protected $table = 'nomina_dotacion';
  protected $fillable = [
    'empresa_id', 'nomina_id', 'entrega', 'dotacion_id',
  ];
}
