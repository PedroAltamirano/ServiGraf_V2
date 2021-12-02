<?php

namespace App\Http\Requests\Administracion;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CI;

class StoreFactura extends FormRequest
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
      'numero' => ['required', 'numeric'],
      'fact_emp_id' => ['required', 'numeric'],
      'cliente_id' => ['required', 'numeric'],
      'ruc' => ['required', 'string', new CI],
      'telefono' => ['required', 'string'],
      'direccion' => ['required', 'string'],
      'emision' => ['required', 'date'],
      'vencimiento' => ['required', 'date'],
      'tipo' => ['required', 'boolean'],
      'estado' => ['required', 'numeric'],
      'tipo_pago' => ['required', 'numeric'],
      //articulos
      'articulo_cantidad.*' => ['required', 'numeric'],
      'articulo_detalle.*' => ['required', 'string'],
      'articulo_iva_id.*' => ['required', 'numeric'],
      'articulo_valor_unitario.*' => ['required', 'numeric'],
      'articulo_subtotal.*' => ['required', 'numeric'],
      //values
      'subtotal' => ['required', 'numeric'],
      'descuento_p' => ['required', 'numeric'],
      'descuento' => ['required', 'numeric'],
      'iva' => ['required', 'numeric'],
      'iva_0' => ['required', 'numeric'],
      'total' => ['required', 'numeric'],
      'ret_iva_p' => ['required', 'numeric'],
      'ret_iva' => ['required', 'numeric'],
      'ret_fuente_p' => ['required', 'numeric'],
      'ret_fuente' => ['required', 'numeric'],
      'total_pagar' => ['required', 'numeric'],
      'notas' => ['nullable', 'string'],
      // pedidos
      'pedidos.*' => ['numeric', 'exists:pedidos,id']
    ];
  }
}
