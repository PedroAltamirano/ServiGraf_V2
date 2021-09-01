<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dotacion extends Model
{
  use HasFactory;

  protected $table = 'dotacion';

  protected $fillable = [
    'empresa_id', 'dotacion', 'status',
  ];
}
