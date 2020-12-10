<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';

    public $attributes =[
    'tipo' => 0 , 'subprocesos' => 0, 'seguimiento' => 0, 'meta' => 0.00
    ];

    protected $fillable = [
        'empresa_id', 'area_id', 'servicio', 'meta', 'tipo', 'tmaquina', 'toperador', 'subprocesos', 'seguimiento',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function area()
    {
        return $this->belongsTo('App\Models\Produccion\Area');
    }

    public function subservicios(){
    return $this->hasMany('App\Models\Produccion\Sub_servicio');
    }
}
