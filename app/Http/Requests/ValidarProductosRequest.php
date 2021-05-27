<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarProductosRequest extends FormRequest
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
            'inputCodigo' => 'required|min:4|unique:productos,codigo',
            'inputDescripcion' => 'required|string|max:50|unique:productos,descripcion',
            'inputCategoria' => 'required|string|max:255',
            'inputPrecioc' => 'required',
            'inputGanancia' => 'required',
            'inputPreciov' => 'required',
            'inputExiste' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'   => 'El :attribute es obligatorio.',
            'nombre.alpha'     => 'El :attribute debe contener cadenas de texto.',



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
