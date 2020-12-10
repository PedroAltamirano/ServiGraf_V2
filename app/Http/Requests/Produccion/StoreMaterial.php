<?php

namespace App\Http\Requests\Produccion;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterial extends FormRequest
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
            'descripcion' => ['required', 'string'],
            'categoria_id' => ['required', 'numeric', 'exists:categorias,id'],
            'color' => ['nullable', 'boolean'],
            'alto' => ['required', 'numeric', 'max:130.00'],
            'ancho' => ['required', 'numeric', 'max:130.00'],
            'precio' => ['required', 'numeric', 'max:99.99'],
            'uv' => ['nullable', 'boolean'],
            'plastificado' => ['nullable', 'boolean']
        ];
    }
}
