<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente_empresa extends Model
{
  use SoftDeletes;

  protected $table = 'cliente_empresas';

  protected $fillable = [
    'nombre', 'ruc', 'empresa_id',
  ];

  public function clientes()
  {
    return $this->hasMany(Cliente::class, 'cliente_empresa_id');
  }

  public function contactos()
  {
    return $this->hasMany(Contacto::class, 'cliente_empresa_id')->orderBy('nombre');
  }
}
