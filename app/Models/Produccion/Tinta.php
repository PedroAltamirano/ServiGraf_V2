<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Tinta extends Model
{
  use SoftDeletes, CascadeSoftDeletes;

  protected $table = 'tintas';

  protected $fillable = [
    'empresa_id', 'color'
  ];

  protected $cascadeDeletes = ['pedido_tinta'];

  /**
   * Get all of the pedido_tinta for the Tinta
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function pedido_tinta()
  {
    return $this->hasMany(Pedido_tintas::class);
  }
}
