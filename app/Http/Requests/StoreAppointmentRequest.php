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
            'scheduled_date' => ['required', 'date', 'after_or_equal:today', 
            //Only from Monday to Friday
                function ($attribute, $value, $fail) {
                    $date = now()->parse($value);
                    if ($date->isWeekend()) {
                        $fail('El día seleccionado no es válido, solo se puede agendar de lunes a viernes');
                    }
                }
            ],
            'scheduled_time' => ['required', 'date_format:H:i', 'after_or_equal:09:00', 'before_or_equal:18:00', 
                // excepto from 12:00 to 16:00
                function ($attribute, $value, $fail) {
                    $from = now()->setTime(12, 0, 0);
                    $to = now()->setTime(16, 0, 0);
                    $scheduled_time = now()->setTimeFromTimeString($value);
                    if ($scheduled_time->between($from, $to)) {
                        $fail('El horario de atención es de 09:00 a 12:00 y de 16:00 a 18:00');
                    }
                }   
            ],
            'status' => ['required', 'in:Pendiente', 'string' ],
            'notes' => ['required', 'string', 'max:255', 'min:3'],
        ];
    }
}
