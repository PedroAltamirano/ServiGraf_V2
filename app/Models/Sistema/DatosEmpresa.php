<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\Empresas;

class DatosEmpresa extends Model
{
  use SoftDeletes;

  protected $table = 'datos_empresas';

  protected $fillable = [
    'empresa_id', 'usuario_id_mod', 'nombre', 'representante', 'ruc', 'ciudad', 'direccion', 'telefono', 'celular', 'web', 'correo', 'inicio', 'cloud', 'mail',
  ];

  /**
   * Get the user that owns the DatosEmpresa
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function empresa()
  {
    return $this->belongsTo(Empresas::class, 'empresa_id');
  }
}
