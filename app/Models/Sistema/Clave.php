<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clave extends Model
{
  use SoftDeletes;

  protected $table = 'claves';

  protected $fillable = [
    'empresa_id', 'cuenta', 'usuario', 'clave', 'refuerzo', 'url'
  ];
}
