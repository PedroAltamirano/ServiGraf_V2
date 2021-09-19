<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
  use SoftDeletes;

  protected $table = 'materiales';

  public $attributes = [
    'color' => 0, 'uv' => 0, 'plastificado' => 0
  ];

  protected $fillable = [
    'empresa_id', 'descripcion', 'categoria_id', 'color', 'alto', 'ancho', 'precio', 'uv', 'plastificado'
  ];

  protected $hidden = [
    'created_at', 'updated_at',
  ];

  protected $cascadeDeletes = ['solicitudes'];

  public function categoria()
  {
    return $this->belongsTo(Categoria::class);
  }

  /**
   * Get all of the solicitudes for the Material
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function solicitudes()
  {
    return $this->hasMany(Solicitud_material::class);
  }
}
