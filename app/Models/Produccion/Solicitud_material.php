<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud_material extends Model
{
  use SoftDeletes;

  protected $table = 'solicitud_materials';

  public function material()
  {
    return $this->belongsTo(Material::class, 'material_id');
  }
}
