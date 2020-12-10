<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'empresa_id', 'categoria'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
