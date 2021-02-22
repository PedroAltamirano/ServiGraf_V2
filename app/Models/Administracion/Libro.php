<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Libro extends Model
{
  protected $table = 'libros';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'libro'
  ];

  public $attributes = [
  ];
}
