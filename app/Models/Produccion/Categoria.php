<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Categoria extends Model
{
  use SoftDeletes, CascadeSoftDeletes;

  protected $table = 'categorias';

  protected $fillable = [
    'empresa_id', 'categoria'
  ];

  protected $hidden = [
    'created_at', 'updated_at'
  ];

  protected $cascadeDeletes = ['materiales'];

  /**
   * Get all of the materiales for the Categoria
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function materiales()
  {
    return $this->hasMany(Material::class);
  }
}
