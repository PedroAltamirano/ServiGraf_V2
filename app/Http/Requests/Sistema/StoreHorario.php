<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class StoreHorario extends FormRequest
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
            'nombre' => [],
            'llegada_ma' => [],
            'salida_ma' => [],
            'llegada_ta' => [],
            'salida_ta' => [],
            'espera' => [],
            'gracia' => [],
        ];
    }
}
