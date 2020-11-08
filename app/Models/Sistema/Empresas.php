<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model{
    protected $table = 'empresas';
    public $incrementing = false;

    protected $attributes = [
        'status' => 1,
    ];

    protected $fillable = [
        'id', 'nombre', 'status'
    ];

    public function nomina() {
        return $this->hasMany('App\Models\Sistema\Nomina', 'empresa_id');
    }

    public function usuarios() {
        return $this->hasMany('App\Models\Usuarios\Usuario', 'empresa_id');
    }

    public function tipoEmpresa() {
        return $this->belongsTo('App\Models\Sistema\Tipo_empresa');
    }
}
