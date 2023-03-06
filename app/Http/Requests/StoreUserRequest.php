<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * Reglas de validacion
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'max:15', 'unique:users,username', 'regex:/^[\w.-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'email_verified_at' => ['required', 'string', 'max:2'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required', 'array'],
            'roles.*' => ['required', 'exists:roles,id', 'numeric'],
        
            'cedula' => ['required', 'numeric', 'unique:people,cedula'],
            'nombres' => ['required', 'string', 'max:15', 'min:3'],
            'apellidos' => ['required', 'string', 'max:15', 'min:3'],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:25', 'min:3', 'string'],
            'ciudad' => ['required', 'string', 'max:10'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string', 'max:10'],
            'specialities' => ['array'],
            'specialities.*' => ['numeric', 'exists:specialities,id']
        ];
    }
}
