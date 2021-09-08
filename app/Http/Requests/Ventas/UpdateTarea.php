<?php

namespace App\Http\Requests\Ventas;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTarea extends FormRequest
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
      'contacto_id' => ['nullable', 'numeric', 'exists:contactos,id'],
      'actividad_id' => ['required', 'numeric', 'exists:actividades,id'],
      'asignado_id' => ['required', 'numeric', 'exists:usuarios,cedula'],
      'estado' => ['nullable', 'boolean'],
      'fecha' => ['required', 'date'],
      'hora' => ['required', 'date_format:H:i'],
      // 'fuente' => ['nullable'],
      // 'campania' => ['nullable'],
      'nota' => ['nullable', 'string'],
    ];
  }
}
