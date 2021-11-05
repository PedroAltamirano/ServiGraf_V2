<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\Nomina;
use App\Models\Usuarios\Usuario;
use App\Models\Sistema\DatosEmpresa;
use App\Models\Sistema\Tipo_empresa;

class Empresas extends Model
{
  use SoftDeletes;

  protected $table = 'empresas';
  public $incrementing = false;

  protected $attributes = [
    'status' => 1,
  ];

  protected $fillable = [
    'id', 'nombre', 'tipo_empresa_id', 'status'
  ];

  public function datos()
  {
    return $this->hasOne(DatosEmpresa::class, 'empresa_id');
  }

  public function nomina()
  {
    return $this->hasMany(Nomina::class, 'empresa_id');
  }

  public function usuarios()
  {
    return $this->hasMany(Usuario::class, 'empresa_id');
  }

  public function tipo_empresa()
  {
    return $this->belongsTo(Tipo_empresa::class);
  }

  public function root()
  {
    return $this->hasOne(Usuario::class, 'empresa_id')->orderBy('created_at', 'asc')->with('nomina');
  }
}
