<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
  protected $table = 'contactos';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'cliente_empresa_id', 'actividad', 'titulo', 'nombre', 'apellido', 'cargo', 'direccion', 'sector', 'telefono', 'celular', 'extencion', 'email', 'web',
  ];

  protected $hidden = [
    'created_at', 'updated_at'
  ];
}
