<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';

    public $attributes =[
        'color' => 0, 'uv' => 0, 'plastificado' => 0
    ];

    protected $fillable = [
        'empresa_id', 'descripcion', 'categoria_id', 'color', 'alto', 'ancho', 'precio', 'uv', 'plastificado'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 
    ];

    public function categoria(){
        return $this->belongsTo('App\Models\Produccion\Categoria');
    }
}
