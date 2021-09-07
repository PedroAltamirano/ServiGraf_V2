<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Proceso extends Model
{
  use NodeTrait;

  protected $table = 'procesos';

  public $attributes = [
    'tipo' => 0, 'seguimiento' => 0, 'meta' => 0.00
  ];

  protected $fillable = [
    'empresa_id', 'area_id', 'proceso', 'meta', 'tipo', 'tmaquina', 'toperador', 'seguimiento', 'parent_id'
  ];

  protected $hidden = [
    'created_at', 'updated_at'
  ];

  public function area()
  {
    return $this->belongsTo(Area::class);
  }

  // public function parent()
  // {
  //   return $this->belongsTo(Proceso::class, 'parent_id');
  // }

  // public function childs()
  // {
  //   return $this->hasMany(Proceso::class, 'parent_id');
  // }
}
