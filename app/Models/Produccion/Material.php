<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $connection = 'DDBBproduccion';
    protected $table = 'materiales';
  
    public $attributes =[
        'uv' => 0, 'plastificado' => 0
    ];
  
    protected $fillable = [
        'descripcion', 'categoria_id', 'alto', 'ancho', 'precio', 'uv', 'plastifiacado'
    ];
  
    protected $hidden = [
        'created_at', 'updated_at', 'empresa_id'
    ];

    public function categoria(){
        return $this->belongsTo('App\Models\Produccion\Categoria');
    }
}
