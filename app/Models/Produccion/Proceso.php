<?php

namespace App\Models\Produccion;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Proceso extends Model
{
  use NodeTrait, SoftDeletes, CascadeSoftDeletes;

  protected $table = 'procesos';

  public $attributes = [
    'tipo' => 0, 'seguimiento' => 0, 'meta' => 0.00, 'tipo' => 1,
  ];

  protected $fillable = [
    'empresa_id', 'area_id', 'proceso', 'meta', 'tipo', 'tmaquina', 'toperador', 'seguimiento', 'parent_id'
  ];

  protected $hidden = [
    'created_at', 'updated_at'
  ];

  protected $cascadeDeletes = ['pedido_proceso'];

  public function area()
  {
    return $this->belongsTo(Area::class);
  }

  /**
   * Get all of the pedido_proceso for the Proceso
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function pedido_proceso()
  {
    return $this->hasMany(Pedido_proceso::class);
  }
}
