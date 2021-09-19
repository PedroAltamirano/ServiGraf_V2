<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModPerfRol extends Model
{
  use SoftDeletes;

  protected $table = 'modulo_perfil';

  protected $fillable = [
    'modulo_id', 'rol_id'
  ];

  protected $hidden = [
    'id', 'created_at', 'updated_at', 'perfil_id'
  ];
}
