<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

use App\models\Sistema\Nomina;

class Asistencia extends Model
{
  protected $table = 'asistencias';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'fecha', 'llegada_mañana', 'salida_mañana', 'llegada_tarde', 'salida_tarde', 'total', 'extras'
  ];

  public $attributes = [
  ];

  /**
   * Get the user that owns the Asistencia
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function nomina() {
      return $this->belongsTo(Nomina::class, 'usuario_id', 'cedula');
  }
}
