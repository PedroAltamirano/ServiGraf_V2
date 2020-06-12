<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Pedido_tintas extends Model
{
    protected $connection = 'DDBBproduccion';
    protected $table = 'ot_tintas';
}
