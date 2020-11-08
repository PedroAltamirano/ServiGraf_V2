<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
   protected $table = 'servicios';

   public $attributes =[
       'tipo' => 0, 'subprocesos' => 0, 'seguimiento' => 0, 'meta' => 0.00
   ];

   protected $fillable = [
       'area_id', 'servicio', 'meta', 'tipo', 'subprocesos', 'seguimiento'
   ];

   protected $hidden = [
       'created_at', 'updated_at', 'empresa_id'
   ];

   public function area()
   {
       return $this->belongsTo('App\Models\Produccion\Area');
   }

   public function subservicios(){
    return $this->hasMany('App\Models\Produccion\Sub_servicio');
   }
}
