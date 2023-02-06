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
        // return [
        //     'patient_id' => ['required' , 'numeric', 'exists:appointments,patient_id'],
        //     'doctor_id' => ['required' , 'numeric', 'exists:persons,id'],
        //     'speciality_id' => ['required' , 'numeric', 'exists:specialities,id'],
        //     'scheduled_date' => ['required' , 'date', 'after_or_equal:today', 'date_format:Y-m-d', 'unique:appointments,scheduled_date,NULL,id,doctor_id,' . $this->doctor_id, 'unique:appointments,scheduled_date,NULL,id,patient_id,' . $this->patient_id],
        //     'scheduled_time' => ['required' , 'date_format:H:i', 'unique:appointments,scheduled_time,NULL,id,doctor_id,' . $this->doctor_id, 'unique:appointments,scheduled_time,NULL,id,patient_id,' . $this->patient_id],
        //     'status' => ['required' , 'string'],
        //     'notes' => ['required' , 'string', 'max:255', 'min:3'],
        // ];

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
