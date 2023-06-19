<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVitalSignRequest extends FormRequest
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
            'appointment_id' => 'required|exists:appointments,id',
            'height' => 'required|numeric',
            'weight' => 'required|regex:/^\d+(\.\d+)?$/',
            'body_mass_index' => 'required|regex:/^\d+(\.\d+)?$/',
            'temperature' => 'required|regex:/^\d+(\.\d+)?$/',
            'blood_pressure' => 'required|regex:/^\d+(\.\d+)?$/',
            'heart_rate' => 'required|regex:/^\d+(\.\d+)?$/',
            'respiratory_rate' => 'required|regex:/^\d+(\.\d+)?$/',

            // Las siguientes 2 deben ser llenadas por el sistema.
            // 'updated_by' => 'required|string'
            // 'created_by' => 'required|string'
        ];
    }
}
