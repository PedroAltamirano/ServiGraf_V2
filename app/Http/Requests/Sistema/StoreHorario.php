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
            'nombre' => ['required', 'string', 'max:30'],
            'llegada_ma' => ['required', 'date_format:H:i'],
            'salida_ma' => ['required', 'date_format:H:i'],
            'llegada_ta' => ['required', 'date_format:H:i'],
            'salida_ta' => ['required', 'date_format:H:i'],
            'espera' => ['required', 'numeric', 'max:60', 'min:0'],
            'gracia' => ['required', 'numeric', 'max:60', 'min:0'],
        ];
    }
}
