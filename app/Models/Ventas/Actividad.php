<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
  use HasFactory;
  protected $table = 'actividades';
  protected $fillable = [
    'empresa_id', 'creador_id', 'modificador_id', 'nombre', 'meta', 'plantilla_id', 'evaluacion', 'seguimiento'
  ];
}
