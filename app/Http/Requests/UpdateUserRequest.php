<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:15', 'unique:users,username,'. $this->user->id, 'regex:/^[\w.-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $this->user->id],
            'password' => ['nullable','string', 'min:8', 'confirmed'],
            'rolesEdit' => ['required', 'array'],
            'rolesEdit.*' => ['required', 'exists:roles,id', 'numeric'],

            'cedula' => ['required', 'numeric', 'unique:people,cedula,'. $this->user->person->id],
            'nombres' => ['required', 'string', 'max:15', 'min:3'],          
            'apellidos' => ['required', 'string', 'max:15', 'min:3'],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:255', 'min:3', 'string'],
            'ciudad' => ['required', 'string', 'max:20'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string', 'max:10'],
            'status' => 'required|in:Activo,Inactivo',
            'specialitiesEdit' => ['array'],
            'specialitiesEdit.*' => ['numeric', 'exists:specialities,id']
        ];
    }
}
