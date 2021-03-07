<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Iva;
use App\Models\Administracion\Retencion;

class Fact_empr extends Model
{
    protected $table = 'fact_empresa';
    protected $attributes = [
        'status' => 1,
    ];
    protected $fillable = [
        'empresa_id', 'empresa', 'representante', 'ruc', 'direccion', 'correo', 'telefono', 'celular', 'caja', 'inicio', 'valido_de', 'valido_a', 'clave_sri', 'clave_firma_sri', 'iva_id', 'ret_iva_id', 'ret_fuente_id', 'impresion', 'logo', 'status',
    ];

    public function iva()
    {
        return $this->belongsTo(Iva::class, 'iva_id');
    }

    public function ret_iva()
    {
        return $this->belongsTo(Retencion::class, 'ret_iva_id');
    }

    public function ret_fuente()
    {
        return $this->belongsTo(Retencion::class, 'ret_fuente_id');
    }
}
