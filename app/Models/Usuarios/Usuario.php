<?php

namespace App\Models\Usuarios;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Ventas\Cliente;
use App\Models\Sistema\Nomina;
use App\Models\Sistema\Empresas;
use App\Models\Produccion\Proceso;
use App\Models\Usuarios\ModPerfRol;
use App\Models\Administracion\Libro;
use App\Models\Usuarios\UsuarioProceso;
use App\Models\Usuarios\UsuarioClientes;

class Usuario extends Authenticatable
{
  use Notifiable, SoftDeletes;

  protected $table = 'usuarios';
  protected $primaryKey = 'cedula';
  public $incrementing = false;

  public $attributes = [
    'status' => 1,
    'is_superadmin' => 0,
    // 'reservarot' => 1, 'libro' => 1
  ];

  protected $fillable = [
    'cedula', 'empresa_id', 'usuario', 'perfil_id', 'reservarot', 'libro', 'status', 'password', 'utilidad', 'is_superadmin'
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'remember_token',
  ];

  protected $casts = [
    'usuario_verified_at' => 'datetime',
  ];

  public function nomina()
  {
    return $this->belongsTo(Nomina::class, 'cedula');
  }

  public function empresa()
  {
    return $this->belongsTo(Empresas::class, 'empresa_id');
  }

  public function modulos()
  {
    return $this->hasMany(ModPerfRol::class, 'perfil_id', 'perfil_id');
  }

  public function procesos_id()
  {
    return $this->hasMany(UsuarioProceso::class, 'usuario_id', 'cedula');
  }

  public function procesos()
  {
    return $this->hasManyThrough(Proceso::class, UsuarioProceso::class, 'usuario_id', 'id', 'cedula', 'proceso_id');
  }

  public function clientes_id()
  {
    return $this->hasMany(UsuarioClientes::class, 'usuario_id', 'cedula');
  }

  public function clientes()
  {
    return $this->hasManyThrough(Cliente::class, UsuarioClientes::class, 'usuario_id', 'id', 'cedula', 'cliente_id');
  }

  public function libros()
  {
    return $this->hasMany(Libro::class, 'usuario_id');
  }
}
