<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosisRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'appointment_id' => 'required|exists:appointments,id',
            'allergies' => 'nullable|string|max:255',
            'drug_use' => 'required|string|in:Si,No',
            'alcohol_use' => 'required|string|in:Si,No',
            'smoking_use' => 'required|string|in:Si,No',
            'family_background' => 'nullable|string|max:255',
            'surgical_history' => 'nullable|string|max:255',
            'current_medication' => 'nullable|string|max:255',

            // Tabla intermedia:diagnosis_disease Actual
            'current_diseases' => 'nullable|array', //tabla intermedia
                'current_diseases.*.id' => 'nullable|exists:diseases,id',
                'current_diseases.*.duration' => 'nullable|string',
                'current_diseases.*.notes' => 'nullable|string',
                'current_diseases.*.status' => 'nullable|string|in:Enfermedad Actual',

                // Las siguientes 2 deben ser llenadas por el sistema.
                //'diagnosis_id' => 'required|exists:diagnoses,id',
                //'disease_id' => 'required|exists:diseases,id',

            // Tabla intermedia:diagnosis_disease Posible
            'possiblediseases' => 'array', //tabla intermedia
                'possiblediseases.*.id' => 'exists:diseases,id',
                'possiblediseases.*.notes' => 'string',
                'possiblediseases.*.status' => 'string|in:Posible Enfermedad,Enfermedad Confirmada',

            // Tabla intermedia:diagnosis_symptom
            'symptoms' => 'array', //tabla intermedia
                'symptoms.*.id' => 'exists:symptoms,id',
                'symptoms.*.duration' => 'string',
                'symptoms.*.notes' => 'string',

                // Las siguientes 2 deben ser llenadas por el sistema.
                //'diagnosis_id' => 'required|exists:diagnoses,id',
                //'symptom_id' => 'required|exists:symptoms,id',

            'reason_for_consultation' => 'required|string|max:255',
            'conclusions' => 'required|string|max:255',
        ];
    }
}
