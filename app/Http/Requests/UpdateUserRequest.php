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
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'roles' => ['required'],
        ];
    }
}
