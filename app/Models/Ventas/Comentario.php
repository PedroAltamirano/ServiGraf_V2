<?php

namespace App\Models\Ventas;

use App\Models\Sistema\Nomina;
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Comentario extends Model
{
  use HasFactory, NodeTrait;
  protected $table = 'comentarios';
  protected $fillable = [
    'empresa_id', 'creador_id', 'contacto_id', 'comentario', 'parent_id'
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

  public function nomina()
  {
    return $this->belongsTo(Nomina::class, 'creador_id', 'cedula');
  }
}
