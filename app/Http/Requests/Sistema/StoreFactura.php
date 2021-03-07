<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

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
            'empresa' => ['required', 'string', 'max:50'],
            'representante' => ['required', 'string', 'max:50'],
            'direccion' => ['required', 'string', 'max:250'],
            'correo' => ['required', 'string', 'max:250'],
            'telefono' => ['required', 'numeric', 'regex:/[0-9]{7}/'],
            'celular' => ['required', 'numeric', 'regex:/[0-9]{10}/'],
            'ruc' => ['required', 'numeric', 'regex:/[\d]{13}/i'],
            'valido_de' => ['required', 'date'],
            'valido_a' => ['nullable', 'date'],
            'clave_sri' => ['nullable', 'string'],
            'clave_firma_sri' => ['nullable', 'string'],
            'caja' => ['required', 'string', 'max:7', 'regex:/[0-9]{3}-[0-9]{3}/i'],
            'inicio' => ['required', 'numeric', 'max:9999999'],
            'iva_id' => ['required', 'numeric', 'exists:ivas,id'],
            'ret_iva_id' => ['required', 'numeric', 'exists:retenciones,id'],
            'ret_fuente_id' => ['required', 'numeric', 'exists:retenciones,id'],
            'impresion' => ['nullable', 'boolean'],
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'status' => ['required', 'boolean'],
        ];
    }
}
