<?php

namespace App\Http\Requests\Produccion;

use Illuminate\Foundation\Http\FormRequest;

class StoreProceso extends FormRequest
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
            'area_id' => ['required', 'numeric', 'exists:areas,id'],
            'proceso' => ['required', 'string', 'max:140'],
            'parent_id' => ['nullable', 'numeric', 'exists:procesos,id'],
            'meta' => ['required', 'numeric', 'max:99999,99'],
            'tipo' => ['required', 'boolean'],
            'tmaquina' => ['nullable'],
            'toperador' => ['nullable'],
            'seguimiento' => ['nullable', 'boolean'],
        ];
    }
}
