<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    protected $connection = 'DDBBproduccion';
    protected $table = 'abonos';
}
