<?php

namespace App\Models\Usuarios;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Administracion\Libro;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'cedula';
    public $incrementing = false;

    public $attributes =[
        'status' => 1,
        // 'reservarot' => 1, 'libro' => 1
    ];

    protected $fillable = [
        'cedula', 'empresa_id', 'usuario', 'perfil_id', 'reservarot', 'libro', 'status', 'password', 'utilidad',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'remember_token',
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

    public function modulos() {
        return $this->hasMany('App\Models\Usuarios\ModPerfRol', 'perfil_id', 'perfil_id');
    }

    public function procesos()
    {
        return $this->hasManyThrough('App\Models\Produccion\Proceso', 'App\Models\Usuarios\UsuarioProceso', 'usuario_id', 'id', 'cedula', 'proceso_id');
    }

    public function clientes()
    {
      return $this->hasManyThrough('App\Models\Ventas\Cliente', 'App\Models\Usuarios\UsuarioClientes', 'usuario_id', 'id', 'cedula', 'cliente_id');
    }

    public function libros()
    {
      return $this->hasMany(Libro::class, 'usuario_id');
    }
}
