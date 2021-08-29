<?php

namespace App\Http\Requests\Administracion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNomina extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      //datos personales
      'foto' => ['required', 'string', 'numeric'],
      'fecha_nacimiento' => ['required', 'string', 'numeric'],
      'lugar_nacimiento' => ['required', 'string', 'numeric'],
      'nacionalidad' => ['required', 'string', 'numeric'],
      'estado_civil' => ['required', 'string', 'numeric'],
      'genero' => ['required', 'string', 'numeric'],
      'idioma_nativo' => ['required', 'string', 'numeric'],
      'cedula' => ['required', 'string', 'numeric'],
      'nombre' => ['required', 'string', 'numeric'],
      'apellido' => ['required', 'string', 'numeric'],
      'direccion' => ['required', 'string', 'numeric'],
      'sector' => ['required', 'string', 'numeric'],
      'visita_domiciliaria' => ['required', 'string', 'numeric'],
      'fecha_visita' => ['required', 'string', 'numeric'],
      'telefono' => ['required', 'string', 'numeric'],
      'celular' => ['required', 'string', 'numeric'],
      'correo' => ['required', 'string', 'numeric'],
      'cant_hijos' => ['required', 'string', 'numeric'],

      //Datos medicos
      'tipo_sangre' => ['required', 'string', 'numeric'],
      'padecimientos_medicos' => ['required', 'string', 'numeric'],
      'alergias' => ['required', 'string', 'numeric'],
      'contacto_emergencia_nombre' => ['required', 'string', 'numeric'],
      'contacto_emergencia_domicilio' => ['required', 'string', 'numeric'],
      'contacto_emergencia_celular' => ['required', 'string', 'numeric'],
      'contacto_emergencia_oficina' => ['required', 'string', 'numeric'],

      //Datos empresariales
      'inicio_labor' => ['required', 'string', 'numeric'],
      'fin_labor' => ['required', 'string', 'numeric'],
      'cargo' => ['required', 'string', 'numeric'],
      'centro_costos' => ['required', 'string', 'numeric'],
      'ingreso_iess' => ['required', 'string', 'numeric'],
      'iess_asumido_empleador' => ['required', 'string', 'numeric'],
      'sueldo' => ['required', 'string', 'numeric'],
      'liquidacion_mensual' => ['required', 'string', 'numeric'],
      'banco_id' => ['required', 'string', 'numeric'],
      'tipo_cuenta_banco' => ['required', 'string', 'numeric'],
      'numero_cuenta_bancaria' => ['required', 'string', 'numeric'],
      'observaciones' => ['required', 'string', 'numeric'],
      'status' => ['required', 'string', 'numeric'],
      'horario_id' => ['required', 'string', 'numeric'],
      'Txhoras' => ['required', 'string', 'numeric'],

      //Familia
      'relacion' => ['required', 'string', 'numeric'],
      'nombre_fam' => ['required', 'string', 'numeric'],
      'fecha_nacimiento_fam' => ['required', 'string', 'numeric'],
      'ocupacion' => ['required', 'string', 'numeric'],
      'telefono_fam' => ['required', 'string', 'numeric'],
      'celular_fam' => ['required', 'string', 'numeric'],

      //Educacion
      'nivel_educ' => ['required', 'string', 'numeric'],
      'nombre_institucion' => ['required', 'string', 'numeric'],
      'inicio' => ['required', 'string', 'numeric'],
      'fin' => ['required', 'string', 'numeric'],
      'titulo' => ['required', 'string', 'numeric'],

      //Documentos
      'aviso_entrada' => ['required', 'string', 'numeric'],
      'contrato_trabajo' => ['required', 'string', 'numeric'],
      'solicitud_empleo' => ['required', 'string', 'numeric'],
      'curriculum_vitae' => ['required', 'string', 'numeric'],
      'cedula_identidad' => ['required', 'string', 'numeric'],
      'papeleta_votacion' => ['required', 'string', 'numeric'],
      'record_policial' => ['required', 'string', 'numeric'],
      'libreta_militar' => ['required', 'string', 'numeric'],
      'certificado_escolar' => ['required', 'string', 'numeric'],
      'certificado_colegio' => ['required', 'string', 'numeric'],
      'certificado_universitario' => ['required', 'string', 'numeric'],
      'certificado_otros' => ['required', 'string', 'numeric'],
      'referencia_empleos' => ['required', 'string', 'numeric'],
      'referencia_personales' => ['required', 'string', 'numeric'],
      'certificado_medico' => ['required', 'string', 'numeric'],
      'aviso_salida' => ['required', 'string', 'numeric'],
      'acta_finiquito' => ['required', 'string', 'numeric'],
      'recibo_pago_acta_fini' => ['required', 'string', 'numeric'],

      //Referencias
      'tipo_refer' => ['required', 'string', 'numeric'],
      'empresa' => ['required', 'string', 'numeric'],
      'contacto' => ['required', 'string', 'numeric'],
      'telefono_refer' => ['required', 'string', 'numeric'],
      'afinidad' => ['required', 'string', 'numeric'],
      'inicio_labor_refer' => ['required', 'string', 'numeric'],
      'fin_labor_refer' => ['required', 'string', 'numeric'],
      'cargo_refer' => ['required', 'string', 'numeric'],
      'razon_separacion' => ['required', 'string', 'numeric'],

      //Dotacion
      'entrega' => ['required', 'string', 'numeric'],
      'dotacion_id' => ['required', 'string', 'numeric'],
    ];
  }
}
