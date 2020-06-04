<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Pedido_servicio extends Model
{
    protected $connection = 'DDBBproduccion';
    protected $table = 'pedido_servicios';

    public $attributes =[
        'status' => 0
    ];

    protected $fillable = [
        'servicio_id', 'subservicio_id', 'tiro', 'retiro', 'millares', 'valor_unitario', 'total', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'ot_id'
    ];

    function ot()
    {
        return $this->belongsTo('App\Models\Produccion\Pedido');
    }

    function servicio()
    {
        return $this->belongsTo('App\Models\Produccion\Servicio');
    }

    public function sub_servicio()
    {
        return $this->belongsTo('App\Models\Produccion\Sub_servicio', 'subservicio_id');
    }
    
}
