<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
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


    public function rules()
    {
        return [
            'appointment_id' => 'required|exists:appointments,id',
            'doctor_qualification' => 'required|string|in:Buena,Regular,Mala',
            'satisfaction' => 'required|string|in:Si,No,Tal vez',
            'recommendation' => 'nullable|string|max:255',
        ];
    }
}
