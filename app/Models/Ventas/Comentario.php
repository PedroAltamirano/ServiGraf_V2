<?php

namespace App\Models\Ventas;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Sistema\Nomina;
use App\Models\Usuarios\Usuario;

class Comentario extends Model
{
  use HasFactory, NodeTrait, SoftDeletes;

  protected $table = 'comentarios';
  protected $fillable = [
    'empresa_id', 'creador_id', 'asignado_id', 'contacto_id', 'comentario', 'parent_id'
  ];

  /**
   * Get the contacto that owns the Comentario
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function contacto()
  {
    return $this->belongsTo(Contacto::class);
  }

  public function creador()
  {
    return $this->belongsTo(Usuario::class, 'creador_id', 'cedula');
  }

  public function asignado()
  {
    return $this->belongsTo(Usuario::class, 'asignado_id', 'cedula');
  }

  public function nomina()
  {
    return $this->belongsTo(Nomina::class, 'creador_id', 'cedula');
  }
}
