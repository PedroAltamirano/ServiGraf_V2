<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NominaDotacion extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'nomina_dotacion';
  protected $fillable = [
    'empresa_id', 'nomina_id', 'entrega', 'dotacion_id',
  ];
}
