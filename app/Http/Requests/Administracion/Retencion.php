<?php

namespace App\Http\Requests\Administracion;

use Illuminate\Foundation\Http\FormRequest;

class Retencion extends FormRequest
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
          'porcentaje' => ['required', 'numeric'],
          'tipo' => ['required', 'boolean'],
          'descripcion' => ['required', 'string', 'max:250'],
          'status' => ['nullable', 'boolean'],
        ];
    }
}
