<?php

namespace App\Http\Requests\Produccion;

use Illuminate\Foundation\Http\FormRequest;

class AbonoRequest extends FormRequest
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
      'pedido_id' => ['required', 'numeric', 'exists:pedidos,id'],
      'abono_fecha.*' => ['required', 'date'],
      'abono_usuario.*' => ['required', 'numeric', 'exists:usuarios,cedula'],
      'abono_pago.*' => ['required', 'numeric'],
      'abono_valor.*' => ['required', 'numeric'],
      'abono' => ['required', 'numeric', 'min:0'],
    ];
  }
}
