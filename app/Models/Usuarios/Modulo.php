<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Modulo extends Model
{
  protected $table = 'modulos';
  public $incrementing = false;

  protected $fillable = [
    'id', 'nombre', 'principal'
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'empresa_id'
  ];

  public static function todos()
  {
    return Modulo::select('id', 'nombre', 'principal')->orderBy('id')->get();
    // return Modulo::select('id', 'nombre', 'principal')->where('empresa_id', Auth::user()->empresa_id)->orderBy('id')->get();
  }
}
