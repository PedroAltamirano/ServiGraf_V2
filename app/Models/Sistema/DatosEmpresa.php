<?php

namespace App\Models\Sistema;

use App\Models\Sistema\Empresas;
use Illuminate\Database\Eloquent\Model;

class DatosEmpresa extends Model{
  protected $table = 'datos_empresas';

  protected $fillable = [
    'empresa_id', 'usuario_id_mod', 'nombre', 'representante', 'ruc', 'ciudad', 'direccion', 'telefono', 'celular', 'web', 'correo', 'inicio', 'cloud'
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
