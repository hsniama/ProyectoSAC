<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'speciality_id' => 'required',
            'scheduled_date' => ['required', 'date', 'after_or_equal:today', 'date_format:Y-m-d', 'unique:appointments,scheduled_date,NULL,id,doctor_id,' . $this->doctor_id, 'unique:appointments,scheduled_date,NULL,id,patient_id,' . $this->patient_id],
            'scheduled_time' => ['required', 'date_format:H:i', 'unique:appointments,scheduled_time,NULL,id,doctor_id,' . $this->doctor_id, 'unique:appointments,scheduled_time,NULL,id,patient_id,' . $this->patient_id],
            'status' => ['required', 'in:Pendiente', 'string' ],
            'notes' => ['required', 'string', 'max:255', 'min:3'],     
        ];
    }
}
