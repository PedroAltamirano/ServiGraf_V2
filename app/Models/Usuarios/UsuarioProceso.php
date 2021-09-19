<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsuarioProceso extends Model
{
  use SoftDeletes;

  protected $table = 'usuario_proceso';
  protected $fillable = [
    'proceso_id', 'usuario_id',
  ];
}
