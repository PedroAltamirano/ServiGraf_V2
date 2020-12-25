<?php

namespace App\Http\Requests\Ventas;

use Illuminate\Foundation\Http\FormRequest;

class StoreCliente extends FormRequest
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
        'empresa' => ['required', 'string'], //nombre de la empresa
        'ruc' => ['required', 'numeric'], //ruc de la empresa

        'actividad' => ['nullable', 'string'],
        'cargo' => ['required', 'string'],
        'titulo' => ['nullable', 'string'],
        'nombre' => ['required', 'string'],
        'apellido' => ['required', 'string'],
        'direccion' => ['required', 'string'],
        'sector' => ['nullable', 'string'],
        'extencion' => ['nullable', 'numeric'],
        'telefono' => ['nullable', 'numeric', 'required_if:celular,null'],
        'celular' => ['nullable', 'numeric', 'required_if:telefono,null'],
        'email' => ['required', 'email'],
        'web' => ['nullable', 'url'],
        'seguimiento' => ['nullable', 'boolean'],
        'isCliente' => ['nullable', 'boolean'],
      ];
    }
}
