<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    // public $attributes =[
    // ];

    protected $fillable = [
        'proveedor', 'telefono', 'direccion'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'empresa_id', 'usuario_id'
    ];
}
