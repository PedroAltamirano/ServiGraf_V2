<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';
    protected $primaryKey = 'id';

    protected $attributes = [
        'espera' => 10, 'gracia' => 5
    ];

    protected $fillable = [
        'empresa_id', 'nombre', 'llegada_ma', 'salida_ma', 'llegada_ta', 'salida_ta', 'espera', 'gracia',
    ];
}
