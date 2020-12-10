<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class Clave extends Model
{
    protected $table = 'claves';

    protected $fillable = [
        'empresa_id', 'cuenta', 'usuario', 'clave', 'refuerzo', 'url'
    ];
}
