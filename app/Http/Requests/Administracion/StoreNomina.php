<?php

namespace App\Http\Requests\Administracion;

use Illuminate\Foundation\Http\FormRequest;

class StoreNomina extends FormRequest
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
      // Datos personales
      'foto' => ['required', 'file', 'mimes:png,jpg,jpeg', 'max:2048'],
      'fecha_nacimiento' => ['required', 'date'],
      'lugar_nacimiento' => ['required', 'string', 'max:100'],
      'nacionalidad' => ['required', 'string', 'max:50'],
      'estado_civil' => ['required', 'numeric'],
      'genero' => ['required', 'numeric'],
      'idioma_nativo' => ['required', 'string', 'max:50'],
      'cedula' => ['required', 'numeric', 'max:9999999999999'],
      'nombre' => ['required', 'string', 'max:30'],
      'apellido' => ['required', 'string', 'max:30'],
      'telefono' => ['nullable', 'numeric', 'max:9999999'],
      'celular' => ['required', 'numeric', 'max:999999999'],
      'correo' => ['required', 'string', 'max:255'],
      'cant_hijos' => ['nullable', 'numeric'],

      // Datos domiciliarios
      'direccion' => ['required', 'string', 'max:255'],
      'sector' => ['nullable', 'string', 'max:30'],
      'visita_domiciliaria' => ['nullable', 'boolean'],
      'fecha_visita' => ['nullable', 'date'],

      // Datos empresariales
      'inicio_labor' => ['required', 'date'],
      'fin_labor' => ['nullable', 'date'],
      'cargo' => ['required', 'string', 'max:50'],
      'sueldo' => ['required', 'numeric'],
      'status' => ['required', 'boolean'],
      'centro_costos' => ['nullable', 'numeric', 'exists:centro_costos,id'],
      'ingreso_iess' => ['nullable', 'date'],
      'iess_asumido_empleador' => ['nullable', 'boolean'],
      'liquidacion_mensual' => ['nullable', 'boolean'],
      'Txhoras' => ['nullable', 'boolean'],
      'horario_id' => ['required', 'numeric', 'exists:horarios,id'],
      'observaciones' => ['nullable', 'string', 'max:255'],
      'banco_id' => ['nullable', 'numeric', 'exists:bancos,id'],
      'tipo_cuenta_banco' => ['nullable', 'numeric'],
      'numero_cuenta_bancaria' => ['nullable', 'numeric'],

      // Documentos
      'aviso_entrada' => ['nullable', 'boolean'],
      'contrato_trabajo' => ['nullable', 'boolean'],
      'solicitud_empleo' => ['nullable', 'boolean'],
      'curriculum_vitae' => ['nullable', 'boolean'],
      'cedula_identidad' => ['nullable', 'boolean'],
      'papeleta_votacion' => ['nullable', 'boolean'],
      'record_policial' => ['nullable', 'boolean'],
      'libreta_militar' => ['nullable', 'boolean'],
      'certificado_escolar' => ['nullable', 'boolean'],
      'certificado_colegio' => ['nullable', 'boolean'],
      'certificado_universitario' => ['nullable', 'boolean'],
      'certificado_otros' => ['nullable', 'boolean'],
      'referencia_empleos' => ['nullable', 'boolean'],
      'referencia_personales' => ['nullable', 'boolean'],
      'certificado_medico' => ['nullable', 'boolean'],
      'aviso_salida' => ['nullable', 'boolean'],
      'acta_finiquito' => ['nullable', 'boolean'],
      'recibo_pago_acta_fini' => ['nullable', 'boolean'],

      // Educacion
      'nivel_educ.*' => ['required', 'numeric'],
      'nombre_institucion.*' => ['required', 'string', 'max:100'],
      'inicio.*' => ['required', 'date'],
      'fin.*' => ['required', 'date'],
      'titulo.*' => ['required', 'string', 'max:255'],

      // Referencias
      'tipo_refer.*' => ['required', 'numeric'],
      'empresa.*' => ['required', 'string', 'max:50'],
      'contacto.*' => ['required', 'string', 'max:100'],
      'telefono_refer.*' => ['required', 'numeric', 'max:9999999'],
      'afinidad.*' => ['required', 'string', 'max:50'],
      'inicio_labor_refer.*' => ['required', 'date'],
      'fin_labor_refer.*' => ['required', 'date'],
      'cargo_refer.*' => ['required', 'string', 'max:50'],
      'razon_separacion.*' => ['required', 'string', 'max:250'],

      // Dotacion
      'entrega' => ['nullable', 'date'],
      'dotacion_id' => ['nullable', 'numeric', 'exists:dotacion,id'],

      // Datos medicos
      'contacto_emergencia_nombre' => ['required', 'string', 'max:255'],
      'contacto_emergencia_domicilio' => ['nullable', 'number', 'max:9999999'],
      'contacto_emergencia_celular' => ['required', 'numeric', 'max:999999999'],
      'contacto_emergencia_oficina' => ['nullable', 'numeric', 'max:9999999'],
      'tipo_sangre' => ['required', 'numeric'],
      'padecimientos_medicos' => ['nullable', 'string', 'max:255'],
      'alergias' => ['nullable', 'string', 'max:255'],

      //Familia
      'relacion.*' => ['nullable', 'numeric'],
      'nombre_fam.*' => ['nullable', 'string', 'max:100'],
      'fecha_nacimiento_fam.*' => ['nullable', 'date'],
      'ocupacion.*' => ['nullable', 'string', 'max:50'],
      'telefono_fam.*' => ['nullable', 'numeric', 'max:9999999'],
      'celular_fam.*' => ['nullable', 'numeric', 'max:999999999'],
    ];
  }
}
