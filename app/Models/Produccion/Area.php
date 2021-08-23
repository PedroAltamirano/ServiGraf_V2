<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
  protected $table = 'areas';

  protected $fillable = [
    'empresa_id', 'area', 'orden'
  ];

  protected $hidden = [
    'created_at', 'updated_at',
  ];

  /**
   * Get all of the procesos for the Area
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function procesos()
  {
    return $this->hasMany(Proceso::class);
  }
}
