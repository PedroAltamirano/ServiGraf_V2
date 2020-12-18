<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioServicios extends Model
{
    protected $table = 'usuario_servicio';
    protected $fillable = [
        'servicio_id', 'usuario_id',
    ];
}
