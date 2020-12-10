<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class Fact_empr extends Model
{
    protected $table = 'fact_empresa';
    protected $attributes = [
        'status' => 1,
    ];
    protected $fillable = [
        'empresa_id', 'empresa', 'representante', 'ruc', 'caja', 'inicio', 'valido_de', 'valido_a', 'impresion', 'logo', 'status',
    ];
}
