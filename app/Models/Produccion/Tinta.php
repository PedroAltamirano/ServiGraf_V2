<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tinta extends Model
{
  use SoftDeletes;

  protected $table = 'tintas';
  protected $fillable = [
    'empresa_id', 'color'
  ];
}
