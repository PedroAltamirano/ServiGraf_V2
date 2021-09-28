<?php

namespace App\Http\Requests\Ventas;

use Illuminate\Foundation\Http\FormRequest;

class StoreComentario extends FormRequest
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
      'contacto_id' => ['required', 'numeric', 'exists:contactos,id'],
      'asignado_id' => ['required', 'numeric', 'exists:usuarios,cedula'],
      'comentario' => ['required', 'string', 'max:250'],
      'parent_id' => ['nullable', 'numeric', 'exists:comentarios,id'],
    ];
  }
}
