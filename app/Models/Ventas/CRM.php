<?php

namespace App\Models\Ventas;

use App\Models\Usuarios\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CRM extends Model
{
  use HasFactory;
  protected $table = 'crm';

  /**
   * Get the actividad that owns the Crm
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function actividad()
  {
    return $this->belongsTo(Actividad::class, 'actividad_id');
  }

  /**
   * Get the creador that owns the Crm
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function creador()
  {
    return $this->belongsTo(Usuario::class, 'creador_id', 'cedula');
  }

  /**
   * Get the modificador that owns the Crm
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function modificador()
  {
    return $this->belongsTo(Usuario::class, 'modificador_id', 'cedula');
  }

  /**
   * Get the asignado that owns the Crm
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function asignado()
  {
    return $this->belongsTo(Usuario::class, 'asignado_id', 'cedula');
  }

  /**
   * Get the contacto that owns the Crm
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function contacto()
  {
    return $this->belongsTo(Contacto::class);
  }

  public function getContactoFormatedAttribute()
  {
    $contacto = $this->contacto;
    $empresa = $contacto->empresa;
    return $empresa->nombre . ' / ' . $contacto->full_name . ' / ' . $contacto->movil;
  }
}
