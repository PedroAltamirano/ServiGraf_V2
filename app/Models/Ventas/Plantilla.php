<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plantilla extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'plantillas';
  protected $fillable = [
    'empresa_id', 'creador_id', 'modificador_id', 'nombre', 'contenido', 'logo'
  ];
}
