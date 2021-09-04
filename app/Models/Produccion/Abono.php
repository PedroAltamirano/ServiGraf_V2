<?php

namespace App\Models\Produccion;

use App\Models\Sistema\Nomina;
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
  protected $table = 'abonos';

  /**
   * Get the usuario that owns the Abono
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function usuario()
  {
    return $this->belongsTo(Usuario::class, 'usuario_id', 'cedula');
  }

  /**
   * Get the usuario that owns the Abono
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function nomina()
  {
    return $this->belongsTo(Nomina::class, 'usuario_id', 'cedula');
  }
}
