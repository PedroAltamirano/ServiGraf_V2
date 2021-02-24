<?php

namespace App\Http\Requests\Administracion;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsistencia extends FormRequest
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
          'fecha' => ['required', 'date'],
          'llegada_mañana' => ['required'],
          'salida_mañana' => ['nullable', 'after:llegada_mañana'],
          'llegada_tarde' => ['nullable', 'after:salida_mañana'],
          'salida_tarde' => ['nullable', 'after:llegada_tarde'],
          // 'total' => ['required', 'time'],
          // 'extras' => ['required', 'time']
        ];
    }
}
