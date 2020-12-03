<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class StorePerfil extends FormRequest
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
            'nombre' => 'required|max:50|unique:perfiles,nombre,empresa_id',
            'descripcion' => 'required|max:140',
            'status' => 'required',
            'mod.*.*' => 'string|nullable'
        ];
    }
}
