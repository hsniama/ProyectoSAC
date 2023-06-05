<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Medicine;
use App\Models\Diagnosis;
use App\Models\VitalSign;
use App\Models\Appointment;
use App\Models\MedicalExam;
use App\Services\DiagnosisService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Requests\StoreVitalSignRequest;
use App\Http\Requests\UpdateDiagnosisRequest;
use App\Http\Requests\UpdateVitalSignRequest;
use App\Http\Requests\StorePrescriptionRequest;

class DiagnosisController extends Controller
{

    protected $diagnosisService;

    public function __construct(DiagnosisService $diagnosisService)
    {
        $this->middleware('can:diagnostico-create')->only('create', 'store');

        $this->diagnosisService = $diagnosisService;
    }



    public function index()
    {
        //
    }



    public function create( Appointment $appointment)
    {
        // $diagnosis = new Diagnosis();

        // $diseases  = Disease::pluck('name', 'id');
        $diseases = Disease::all();

        // get all the symptoms:
        $symptoms = Symptom::all();

        $medicines = Medicine::all();

        $exams = MedicalExam::all();

        return view('doctor.diagnosis.create', compact('appointment', 'diseases', 'symptoms', 'medicines', 'exams'));
    }
    
    public function store(UpdateVitalSignRequest $updateVitalSignRequest, StoreDiagnosisRequest $request, StorePrescriptionRequest $prescriptionRequest)
    {
        // SIGNOS VITALES
        $signVitals = $this->diagnosisService->updateSignVitals($updateVitalSignRequest);

        //DIAGNOSTICO
        $diagnosis = $this->diagnosisService->createDiagnosis($request);

        // PRESCRIPCION
        $prescription = $this->diagnosisService->createPrescription($prescriptionRequest);

        // Actualizar el estado de la cita a Atendido
        $appointment = Appointment::find($diagnosis->appointment_id);
        $appointment->status = 'Atendido';
        $appointment->save();

        notify()->success('Diagnóstico registrado con éxito');

        return redirect()->route('home');
    }


    public function show(Diagnosis $diagnosis)
    {
        //
    }


    public function edit(Diagnosis $diagnosis)
    {
        //
    }


    public function update(UpdateDiagnosisRequest $request, Diagnosis $diagnosis)
    {
        //
    }


    public function destroy(Diagnosis $diagnosis)
    {
        //
    }
}
