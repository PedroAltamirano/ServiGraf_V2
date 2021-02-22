<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
  protected $table = 'bancos';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'banco', 'cuenta'
  ];

  public $attributes = [
  ];
}
