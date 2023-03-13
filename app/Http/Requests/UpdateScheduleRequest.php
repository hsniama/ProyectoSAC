<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
            'morning_start' => ['required', 'date_format:H:i:s', 'before:morning_end', 'before:afternoon_start', 'before:afternoon_end', ],
            'morning_end' => ['required', 'date_format:H:i:s', 'after:morning_start', 'after:09:00:00', 'before:afternoon_start'],
            'afternoon_start' => ['required', 'date_format:H:i:s', 'after:morning_end', 'before:afternoon_end'],
            'afternoon_end' => ['required', 'date_format:H:i:s', 'after:afternoon_start'],
        ];
    }
}
