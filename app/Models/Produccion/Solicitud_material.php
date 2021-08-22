<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Solicitud_material extends Model
{
  protected $table = 'solicitud_materials';

  public function material()
  {
      return $this->belongsTo(Material::class, 'material_id');
  }
}
