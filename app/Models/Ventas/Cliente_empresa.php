<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class Cliente_empresa extends Model
{
  protected $table = 'cliente_empresas';

  protected $fillable = [
    'nombre', 'ruc', 'empresa_id',
  ];

  public function clientes()
  {
    return $this->hasMany(Cliente_empresa::class, 'cliente_empresa_id');
  }
}
