<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
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
            'cedula' => ['required', 'numeric', 'unique:people,cedula,'. $this->person->id],
            'apellidos' => ['required', 'string', 'max:255', 'min:3', 'string'],
            'nombres' => ['required', 'string', 'max:255', 'min:3', 'string'],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:255', 'min:3', 'string'],
            'ciudad' => ['required', 'max:255', 'min:3', 'string', 'string'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string'],
            'specialities' => ['array'],
            'specialities.*' => ['numeric', 'exists:specialities,id']
        ];
    }
}
