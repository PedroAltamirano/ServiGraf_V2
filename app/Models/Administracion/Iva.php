<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Iva extends Model
{
  use SoftDeletes;

  protected $table = 'ivas';

  protected $fillable = [
    'empresa_id', 'porcentaje', 'status'
  ];
}
