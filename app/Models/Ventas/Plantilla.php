<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
  use HasFactory;
  protected $table = 'plantillas';
  protected $fillable = [
    'empresa_id', 'creador_id', 'modificador_id', 'nombre', 'contenido', 'logo'
  ];
}
