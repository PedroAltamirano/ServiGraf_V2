<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\Nomina;
use App\Models\Usuarios\Usuario;

class Abono extends Model
{
  use SoftDeletes;

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
