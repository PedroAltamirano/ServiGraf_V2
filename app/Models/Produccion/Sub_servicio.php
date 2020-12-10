<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Sub_servicio extends Model
{
    protected $table = 'sub_servicios';

    protected $fillable = [
        'servicio_id', 'subservicio', 'tipo', 'tmaquina', 'toperador', 
    ];

    public function servicio()
    {
        return $this->belongsTo('App\Models\Produccion\Servicio');
    }
}
