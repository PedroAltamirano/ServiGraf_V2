<?php

namespace App\Models\Usuarios;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $connection = 'DDBBusuarios';
    protected $table = 'usuarios';
    protected $primaryKey = 'cedula';
    public $incrementing = false;

    public $attributes =[
        'status' => 1, 'reservarot' => 1, 'libro' => 1
    ];

    protected $fillable = [
        'cedula', 'empresa_id', 'usuario', 'perfil_id', 'reservarot', 'libro', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'remember_token', 'password'
    ];

    protected $casts = [
        'usuario_verified_at' => 'datetime',
    ];

    public function nomina() {
        return $this->belongsTo('App\Models\Sistema\Nomina', 'cedula');
    }

    public function empresa() {
        return $this->belongsTo('App\Models\Sistema\Empresas', 'empresa_id');
    }
}
