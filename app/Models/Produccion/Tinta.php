<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Tinta extends Model
{
    protected $connection = 'DDBBproduccion';
    protected $table = 'tintas';
}
