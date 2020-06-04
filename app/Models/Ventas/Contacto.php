<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{ 
   protected $connection = 'DDBBclientes';
   protected $table = 'contactos';
//    protected $primaryKey = 'cedula';
//    public $incrementing = false;
 
//    public $attributes =[
//        'activo' => 1, 'reservarot' => 1, 'libro' => 1
//    ];
 
   protected $fillable = [
       'usuario_id', 'empresa', 'actividad', 'titulo', 'nombre', 'apellido', 'cargo', 'direccion', 'sector', 'telefono', 'celular', 'extension', 'email', 'web'
   ];
 
   protected $hidden = [
       'created_at', 'updated_at', 'empresa_id'
   ];
}
