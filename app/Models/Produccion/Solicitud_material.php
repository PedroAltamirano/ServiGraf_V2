<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Solicitud_material extends Model
{
    protected $connection = 'DDBBproduccion';
    protected $table = 'solicitud_materials';
}
