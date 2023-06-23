<?php

namespace App\Observers;

use App\Models\Survey;
use App\Models\Diagnosis;
use App\Mail\SatisfactionSurvey;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DiagnosisObserver
{
    /**
     * Handle the Diagnosis "created" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function created(Diagnosis $diagnosis)
    {
        // Send email to patient
        if (auth()->check()) {
            if(auth()->user()->hasRole('doctor')){      
                $appointment = $diagnosis->appointment;
                $patient = $appointment->patient;

                $survey = new Survey();
                $survey->appointment_id = $appointment->id;
                $survey->save();

                $url = URL::signedRoute('satisfaction_survey', ['survey' => $survey->id]); // este es el enlace del formulario.

                Mail::to($patient->user->email)->send(new SatisfactionSurvey($diagnosis, $url));
            }
        }

    }

    /**
     * Handle the Diagnosis "updated" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function updated(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Handle the Diagnosis "deleted" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function deleted(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Handle the Diagnosis "restored" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function restored(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Handle the Diagnosis "force deleted" event.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return void
     */
    public function forceDeleted(Diagnosis $diagnosis)
    {
        //
    }
}
