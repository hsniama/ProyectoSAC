<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Medicine;
use App\Models\Diagnosis;
use App\Models\Appointment;
use App\Models\MedicalExam;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Requests\UpdateDiagnosisRequest;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Appointment $appointment)
    {
        $diagnosis = new Diagnosis();

        // $diseases  = Disease::pluck('name', 'id');
        $diseases = Disease::all();

        // get all the symptoms:
        $symptoms = Symptom::all();

        $medicines = Medicine::all();

        $exams = MedicalExam::all();

        return view('doctor.diagnosis.create', compact('diagnosis', 'appointment', 'diseases', 'symptoms', 'medicines', 'exams'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiagnosisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiagnosisRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiagnosisRequest  $request
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiagnosisRequest $request, Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosis $diagnosis)
    {
        //
    }
}