<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioClientes extends Model
{
    protected $table = 'usuario_cli-seg';
    protected $fillable = [
        'cliente_id', 'usuario_id',
    ];
}
