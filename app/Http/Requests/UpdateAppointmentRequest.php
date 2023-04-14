<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
            'patient_id' => ['required', 'numeric', 'exists:appointments,patient_id'],
            'doctor_id' => ['required',  'numeric', 'exists:persons,id'],
            'speciality_id' => ['required', 'numeric', 'exists:specialities,id'],
            'scheduled_date' => ['required', 'date', 'date_format:Y-m-d'],
            'scheduled_time' => ['required', 'date_format:H:i'],
            'status' => ['required' , 'string'],
            'notes' => ['required' , 'string', 'max:255', 'min:3'],
        ];
    }
}
