<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSurveyRequest;


class SurveyController extends Controller
{



    public function satisfactionSurvey(Survey $survey)
    {
        return view('emails.satisfaction_survey_form', compact('survey'));
    }


    public function store(StoreSurveyRequest $request)//StoreSurvey
    {

        // create or update survey
        $survey = Survey::updateOrCreate(
            ['appointment_id' => $request->input('appointment_id')],
            [
                'doctor_qualification' => $request->input('doctor_qualification'),
                'satisfaction' => $request->input('satisfaction'),
                'recommendation' => $request->input('recommendation'),
            ]
        );

        // Redireccionar a la vista de agradecimiento
        return view('emails.satisfaction_survey_thanks', compact('survey'));

    }

   
}
