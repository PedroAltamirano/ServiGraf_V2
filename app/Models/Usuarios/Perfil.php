<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Perfil extends Model
{
  protected $connection = 'DDBBusuarios';
  protected $table = 'perfiles';
  protected $primaryKey = 'id';

  protected $attributes = [
    'status' => 1
  ];

  protected $fillable = [
    'id', 'perfil', 'descripcion', 'status'
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'empresa_id'
  ];

  public static function todos(){
    return Perfil::select('id', 'perfil', 'descripcion', 'status')->where('empresa_id', '=', Auth::user()->empresa_id)->get();
  }
}
