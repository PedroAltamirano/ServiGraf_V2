<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
  use SoftDeletes;

  protected $table = 'contactos';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'cliente_empresa_id', 'actividad', 'titulo', 'nombre', 'apellido', 'cargo', 'direccion', 'sector', 'telefono', 'celular', 'extencion', 'email', 'web',
  ];

  protected $hidden = [
    'created_at', 'updated_at'
  ];

  protected $attribute = [
    'seguimiento' => 0
  ];

  /**
   * Get the empresa that owns the Contacto
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function empresa()
  {
    return $this->belongsTo(Cliente_empresa::class, 'cliente_empresa_id');
  }

  /**
   * Get the cliente associated with the Contacto
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function cliente()
  {
    return $this->hasOne(Cliente::class);
    // return $this->hasOne(Cliente::class)->withTrashed();
  }

  public function getMovilAttribute()
  {
    $res = $this->telefono;
    if ($res != '') {
      $res .= ' / ';
    }
    $res .= $this->celular;
    return $res;
  }

  public function getFullNameAttribute()
  {
    return $this->nombre . ' ' . $this->apellido;
  }
}
