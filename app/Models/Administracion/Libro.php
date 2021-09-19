<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
  use SoftDeletes;

  protected $table = 'libros';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'libro'
  ];

  public $attributes = [];
}
