<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('crear usuario');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'email.required' => 'El campo email es obligatorio.',
            // 'email.email' => 'El formato del email no es válido.',
            // 'email.max' => 'El email no puede tener más de :max caracteres.',
            // 'email.unique' => 'El email ya está registrado sistema.',
            'email.unique' => 'El carnet de identidad ya está registrado en el sistema.',
        ];
    }
    public function rules()
    {
        return [
            'nombre'    => 'required|string',
            'apellidos'     => 'required|string',
            'email'         => 'required|string|max:255|unique:usuario',
            'mail' => 'required|unique:usuario',
            'genero'        => 'required|string',
            'telefono'         => 'required|numeric|min:8',
            'direccion'       => 'required|string',
            'cambiar'       => 'string',
            'ciudad'          => 'required|string',
            'rol_id'          => 'required|string'
        ];
    }
}
