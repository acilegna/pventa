<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarFormularioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //esto lo cambiamos a true para poder que nos dé permiso para acceder al request
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
            'nombre' => 'required|alpha',
            'apellidos' => 'required|alpha',
            'telefono' => 'required|numeric',
            'direccion' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'   => 'El :attribute es obligatorio.',
            'nombre.alpha'     => 'El :attribute debe contener cadenas de texto.',

            'apellidos.required'  => 'El :attribute es obligatorio.',
            'apellidos.alpha'     => 'El :attribute debe contener cadenas de texto.',

            'telefono.required'   =>  'El :attribute es obligatorio.',
            'telefono.numeric'   =>  'El :attribute es obligatorio.',

            'direccion.required'  => 'El :attribute es obligatorio.',

        ];
    }
   

    public function attributes()
{
    return [
        'nombre'        => 'nombre de cliente',
        'apellidos'    => 'apellidos',
        'telefono'    => 'telefono de cliente',
        'direccion'         => 'direccion  del cliente',
      
    ];
}
}
