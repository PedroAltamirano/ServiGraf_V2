<?php

namespace App\Http\Requests\Ventas;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActividad extends FormRequest
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
      'nombre' => ['required', 'string'],
      'meta' => ['required', 'numeric', 'min:0', 'max:99999'],
      'plantilla_id' => ['required', 'numeric', 'exists:plantillas,id'],
      'evaluacion' => ['nullable', 'boolean'],
      'seguimiento' => ['nullable', 'boolean'],
    ];
  }
}
