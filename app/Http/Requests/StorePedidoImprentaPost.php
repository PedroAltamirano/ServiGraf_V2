<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoImprentaPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'inicio' => 'required|date',
            'cliente' => 'required|numeric|exists:DDBBclientes.contactos,id',
            'prioridad' => 'required|boolean',
            'estado' => 'required|numeric|min:1|max:4',
            'cotizado' => 'required|numeric|min:0',
            'descripcion' => 'required|string|max:200',
            'papel' => 'required|string|max:200',
            'cantidad' => 'required|numeric|min:1',
            'corte_ancho' => 'required|numeric|min:0',
            'corte_alto' => 'required|numeric|min:0',
            'tinta_tiro.*' => 'required|numeric',
            'tinta_retiro.*' => 'required|numeric',
            'numerado_inicio' => 'required|numeric|min:0',
            'numerado_fin' => 'required|numeric|min:0',
            'totalMaterial' => 'required|numeric|min:0',
            'totalProcesos' => 'required|numeric|min:0.01',
            'totalAbonos' => 'required|numeric|min:0',
            'totalSaldo' => 'required|numeric|min:0.01',
            'notas' => 'nullable|string|max:256',
            
            'material.id.*' => 'required|numeric|exists:DDBBproduccion.materiales,id',
            'material.cantidad.*' => 'required|numeric|min:1',
            'material.corte_alt.*' => 'required|numeric|min:0',
            'material.corte_anc.*' => 'required|numeric|min:0',
            'material.tamanios.*' => 'required|numeric|min:1',
            'material.proveedor.*' => 'required|numeric|exists:DDBBproduccion.proveedores,id',
            'material.factura.*' => 'nullable|numeric',
            'material.total.*' => 'required|numeric|min:0.01',
            
            'proceso.id.*' => 'required|numeric',
            'proceso.tiro.*' => 'required|numeric|min:1',
            'proceso.retiro.*' => 'required|numeric|min:0',
            'proceso.millar.*' => 'required|numeric|min:1',
            'proceso.valor.*' => 'required|numeric|min:0.01',
            'proceso.total.*' => 'required|numeric|min:0.01',
            'proceso.terminado.*' => 'nullable|boolean',
        ];
    }
}
