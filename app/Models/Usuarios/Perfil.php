<?php

namespace App\Models\Usuarios;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
  use SoftDeletes;

  protected $table = 'perfiles';
  protected $primaryKey = 'id';

  protected $attributes = [
    'status' => 1
  ];

  protected $fillable = [
    'id', 'nombre', 'descripcion', 'status', 'empresa_id'
  ];

  protected $hidden = [
    'created_at', 'updated_at'
  ];

  public function modulos()
  {
    return $this->hasMany(ModPerfRol::class);
  }

  public static function todos()
  {
    return Perfil::select('id', 'nombre', 'descripcion', 'status')->where('empresa_id', '=', Auth::user()->empresa_id)->get();
  }
}
