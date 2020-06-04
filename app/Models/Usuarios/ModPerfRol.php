<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;

class ModPerfRol extends Model
{
  protected $connection = 'DDBBusuarios';
  protected $table = 'modulo_perfil';
  protected $primaryKey = 'id';

  protected $fillable = [
    'modulo_id', 'rol_id'
  ];

  protected $hidden = [
    'id', 'created_at', 'updated_at', 'perfil_id'
  ];
}
