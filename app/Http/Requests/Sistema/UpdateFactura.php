<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFactura extends FormRequest
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
            'ruc' => ['required', 'numeric', 'regex:/[\d]{13}/i'],
            'caja' => ['required', 'string', 'max:7', 'regex:/[0-9]{3}-[0-9]{3}/i'],
            'inicio' => ['required', 'numeric', 'max:9999999'],
            'valido_de' => ['required', 'date'],
            'valido_a' => ['required', 'date'],
            'impresion' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:2048'],
            'status' => ['nullable', 'boolean'],
        ];
    }
}
