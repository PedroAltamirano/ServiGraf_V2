<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ESolution\DBEncryption\Traits\EncryptedAttribute;

class Clave extends Model
{
  use SoftDeletes, EncryptedAttribute;

  protected $table = 'claves';

  protected $fillable = [
    'empresa_id', 'cuenta', 'usuario', 'clave', 'refuerzo', 'url'
  ];

  protected $encryptable = [
    'clave', 'refuerzo'
  ];
}
