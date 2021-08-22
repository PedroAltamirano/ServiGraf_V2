<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Pedido_proceso extends Model
{
    protected $table = 'pedido_proceso';

    public $attributes =[
        'status' => 0
    ];

    protected $fillable = [
        'proceso_id', 'subproceso_id', 'tiro', 'retiro', 'millares', 'valor_unitario', 'total', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'ot_id'
    ];

    function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }
}
