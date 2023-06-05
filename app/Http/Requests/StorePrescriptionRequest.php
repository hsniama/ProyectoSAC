<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
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
            //Tabla de Prescription:
            'appointment_id' => 'required|exists:appointments,id',
            'recommendationsPrescription' => 'required|array',
            'recommendationsPrescription.*' => 'required',

            // Tabla intermedia:medicine_prescription
            'medicines' => 'required|array', // aqui esta el id, quantity, duration y observations
                'medicines.*.id' => 'required|exists:medicines,id',
                'medicines.*.quantity' => 'required|numeric',
                'medicines.*.duration' => 'required|numeric',
                'medicines.*.observations' => 'required|string',  
                 // Las siguientes 2 deben ser llenadas por el sistema.
                //  'medicine_id' => 'required|exists:medicines,id',
                //  'prescription_id' => 'required|exists:prescriptions,id',

            // Tabla intermedia:medical_exam_prescription
            'exams' => 'nullable|array', // aqui esta el id y observations
                'exams.*.id' => 'nullable|exists:medical_exams,id',
                'exams.*.observations' => 'nullable|string',
                // Las siguientes 2 deben ser llenadas por el sistema.
                // 'medical_exam_id' => 'required|exists:medical_exams,id',
                // 'prescription_id' => 'required|exists:prescriptions,id
            

        ];
    }
}
