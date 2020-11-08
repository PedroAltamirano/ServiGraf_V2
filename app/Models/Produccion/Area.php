<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = [
        'area', 'orden'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'empresa_id'
    ];
}
