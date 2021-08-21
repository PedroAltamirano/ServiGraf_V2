<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioProceso extends Model
{
    protected $table = 'usuario_proceso';
    protected $fillable = [
        'proceso_id', 'usuario_id',
    ];
}
