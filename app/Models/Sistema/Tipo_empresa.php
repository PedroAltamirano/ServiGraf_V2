<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema\Empresas;

class Tipo_empresa extends Model
{
    protected $table = 'tipo_empresa';

    public function empresas(){
        return $this->hasMany(Empresas::class);
    }
}
