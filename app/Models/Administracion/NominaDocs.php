<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NominaDocs extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'nomina_docs';
  protected $fillable = [
    'empresa_id', 'nomina_id', 'aviso_entrada', 'contrato_trabajo', 'solicitud_empleo', 'curriculum_vitae', 'cedula_identidad', 'papeleta_votacion', 'record_policial', 'libreta_militar', 'certificado_escolar', 'certificado_colegio', 'certificado_universitario', 'certificado_otros', 'referencia_empleos', 'referencia_personales', 'certificado_medico', 'aviso_salida', 'acta_finiquito', 'recibo_pago_acta_fini',
  ];
}
