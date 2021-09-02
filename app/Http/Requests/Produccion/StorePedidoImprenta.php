<?php

namespace App\Http\Requests\Produccion;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoImprenta extends FormRequest
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
  public static function rules()
  {
    return [
      'fecha_entrada' => 'required|date',
      'cliente_id' => 'required|numeric|exists:contactos,id',
      'prioridad' => 'required|boolean',
      'estado' => 'required|numeric|min:1|max:4',
      'cotizado' => 'required|numeric|min:0',
      'detalle' => 'required|string|max:200',
      'papel' => 'required|string|max:200',
      'cantidad' => 'required|numeric|min:1',
      'corte_ancho' => 'required|numeric|min:0',
      'corte_alto' => 'required|numeric|min:0',
      'tinta_tiro.*' => 'required|numeric',
      'tinta_retiro.*' => 'required|numeric',
      'numerado_inicio' => 'required|numeric|min:0',
      'numerado_fin' => 'required|numeric|min:0',
      'total_material' => 'required|numeric|min:0',
      'total_pedido' => 'required|numeric|min:0.01',
      'abono' => 'required|numeric|min:0',
      'saldo' => 'required|numeric|min:0.01',
      'notas' => 'nullable|string|max:256',

      'material_id.*' => 'required|numeric|exists:materiales,id',
      'material_cantidad.*' => 'required|numeric|min:1',
      'material_corte_alt.*' => 'required|numeric|min:0',
      'material_corte_anc.*' => 'required|numeric|min:0',
      'material_tamanios.*' => 'required|numeric|min:1',
      'material_proveedor.*' => 'required|numeric|exists:proveedores,id',
      'material_factura.*' => 'nullable|numeric',
      'material_total.*' => 'required|numeric|min:0.01',

      'proceso_id.*' => 'required|numeric',
      'proceso_tiro.*' => 'required|numeric|min:1',
      'proceso_retiro.*' => 'required|numeric|min:0',
      'proceso_millar.*' => 'required|numeric|min:1',
      'proceso_valor.*' => 'required|numeric|min:0.01',
      'proceso_total.*' => 'required|numeric|min:0.01',
      'proceso_terminado.*' => 'nullable|boolean',
    ];
  }
}
