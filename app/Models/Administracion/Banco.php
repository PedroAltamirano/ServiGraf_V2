<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banco extends Model
{
  use SoftDeletes;

  protected $table = 'bancos';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'banco', 'cuenta'
  ];

  public $attributes = [
  ];
}
