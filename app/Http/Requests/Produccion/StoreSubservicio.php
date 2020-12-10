<?php

namespace App\Http\Requests\Produccion;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubservicio extends FormRequest
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
            'servicio_id' => ['required', 'numeric', 'exists:servicios,id'],
            'subservicio' => ['required', 'string', 'max:140'],
            'tipo' => ['required', 'boolean'],
            'tmaquina' => ['nullable'],
            'toperador' => ['nullable'],
        ];
    }
}
