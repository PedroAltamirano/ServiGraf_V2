<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class StoreClave extends FormRequest
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
            'cuenta' => ['required', 'string', 'max:30'],
            'usuario' => ['required', 'string', 'max:30'],
            'clave' => ['required', 'string', 'max:128'],
            'refuerzo' => ['nullable', 'string', 'max:128'],
            'url' => ['nullable', 'url', 'max:250'],
        ];
    }
}
