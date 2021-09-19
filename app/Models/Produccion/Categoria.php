<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
  use SoftDeletes;

  protected $table = 'categorias';

  protected $fillable = [
    'empresa_id', 'categoria'
  ];

  protected $hidden = [
    'created_at', 'updated_at'
  ];
}
