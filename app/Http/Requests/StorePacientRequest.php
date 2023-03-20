<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'max:15', 'unique:users,username', 'regex:/^[\w.-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'cedula' => ['required', 'numeric', 'unique:people,cedula'],
            'nombres' => ['required', 'string', 'min:3', 'max:15'],
            'apellidos' => ['required', 'string', 'min:3', 'max:15'],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:25', 'min:3', 'string'],     
            'ciudad' => ['required', 'string', 'max:10'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string', 'max:10'],
        ];
    }
}