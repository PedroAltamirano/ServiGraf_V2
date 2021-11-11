<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CI;

class StoreEmpresa extends FormRequest
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
      'nombre' => ['required', 'string', 'max:50'],
      'representante' => ['required', 'string', 'max:50'],
      'ruc' => ['required', 'numeric', new CI],
      'ciudad' => ['required', 'string', 'max:250'],
      'direccion' => ['required', 'string', 'max:250'],
      'ciudad' => ['required', 'string', 'max:250'],
      'telefono' => ['required', 'numeric', 'regex:/[0-9]{7}/'],
      'celular' => ['required', 'numeric', 'regex:/[0-9]{10}/'],
      'web' => ['required', 'url', 'max:250'],
      'correo' => ['required', 'email', 'max:50'],
      'inicio' => ['required', 'numeric', 'max:999999', 'min:0'],
      // 'iva' => ['required', 'numeric', 'max:99', 'min:0'],
      'cloud' => ['nullable', 'url', 'max:250'],
      'mail' => ['nullable', 'url', 'max:250'],
    ];
  }
}
