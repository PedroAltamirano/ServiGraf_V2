<?php

namespace App\Http\Requests\Ventas;

use Illuminate\Foundation\Http\FormRequest;

class StoreActividad extends FormRequest
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
      'meta' => ['nullable', 'numeric', 'min:0', 'max:99999'],
      'plantilla_id' => ['nullable', 'numeric', 'exists:plantillas,id'],
      'evaluacion' => ['nullable', 'boolean'],
      'seguimiento' => ['nullable', 'boolean'],
    ];
  }
}
