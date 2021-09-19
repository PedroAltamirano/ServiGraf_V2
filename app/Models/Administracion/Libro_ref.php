<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro_ref extends Model
{
  use SoftDeletes;

  protected $table = 'libro_refs';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'referencia', 'descripcion'
  ];

  public $attributes = [];
}
