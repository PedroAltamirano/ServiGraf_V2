<?php

namespace App\Usuarios;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'cedula';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula', 'empresa_id', 'usuario', 'nombre', 'apellido', 'correo', 'telefono', 'imagen', 'perfil_id', 'horario_id', 'TXhoras', 'reservarot', 'libro'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'creacion', 'modificacion', 'remember_token', 'password', 'activo'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'usuario_verified_at' => 'datetime',
    ];
}
