<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'cedula' => 'required|numeric',
            'usuario' => 'required|string|max:20',
            'perfil_id' => 'required|numeric',
            'status' => 'required|boolean',
            'reservarot' => 'nullable|boolean',
            'libro' => 'nullable|boolean',
        ];
    }
}
