<?php

namespace App\Http\Requests\Administracion;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntrada extends FormRequest
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
      'fecha' => ['required', 'date'],
      'usuario_id' => ['required', 'numeric', 'exists:usuarios,cedula'],
      'libro_id' => ['required', 'numeric', 'exists:libros,id'],
      'tipo' => ['required', 'boolean'],
      'libro_ref_id' => ['required', 'numeric', 'exists:libro_refs,id'],
      'beneficiario' => ['required', 'string'],
      'ci' => ['nullable', 'numeric'],
      'detalle' => ['required', 'string', 'max:250'],
      // 'ingreso' => ['required', ''],
      // 'egreso' => ['required', ''],
      'banco_id' => ['nullable', 'numeric', 'exists:bancos,id'],
      'cuenta' => ['nullable', 'numeric'],
      'cheque' => ['nullable', 'numeric'],
      'valor' => ['required', 'numeric', 'min:0'],
    ];
  }
}
