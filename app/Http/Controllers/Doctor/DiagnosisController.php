<?php

namespace App\Http\Controllers\Doctor;

use Carbon\Carbon;
use App\Models\Person;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Medicine;
use App\Models\Diagnosis;
use App\Models\VitalSign;
use App\Models\Appointment;
use App\Models\MedicalExam;
use App\Models\Prescription;
use App\Services\DiagnosisService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Requests\StoreVitalSignRequest;
use App\Http\Requests\UpdateDiagnosisRequest;
use App\Http\Requests\UpdateVitalSignRequest;
use App\Http\Requests\StorePrescriptionRequest;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

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



    public function create($encrypted_pending_appointment_id)//Appointment $appointment
    {
        // Recuperar la cita pendiente
        $appointment = Appointment::find(decrypt($encrypted_pending_appointment_id));

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

        notify()->success('Diagnóstico registrado con éxito', 'Estupendo');

        // return redirect()->route('home');
        return view('doctor.diagnosis.prescription', compact('diagnosis', 'prescription', 'signVitals', 'appointment'));
    }


    public function show(Person $patient )//Patient $patient $encrypted_patient_id
    {
        //Recuperar las citas del paciente con status Atendido:
        $appointments = Appointment::with('patient', 'doctor', 'diagnosis', 'vitalSign', 'prescription')
                                    ->where('patient_id', $patient->id) // decrypt($encrypted_patient_id)
                                    ->where('status', 'Atendido')
                                    ->get();

        // Recuperar los datos del paciente
        // $patient = Person::find(decrypt($encrypted_patient_id));
        $patient = Person::find($patient->id);

        smilify('success', 'Historial médico del paciente cargado con éxito.');

        return view('doctor.diagnosis.medicalHistories', compact('appointments', 'patient'));
    }

    public function showDiagnosis($encrypted_appointment_id)//Appointment $appointment
    {

        // Buscar diagnosis por id de la cita
        $diagnosis = Diagnosis::with('appointment', 'diseases', 'symptoms')
                    ->where('appointment_id', decrypt($encrypted_appointment_id))->first();//$appointment->id
        
        // Buscar prescripción por id de la cita
        $prescription = Prescription::with('appointment', 'medicines', 'medicalExams')
                    ->where('appointment_id', decrypt($encrypted_appointment_id))->first();//$appointment->id

        // encontrar cita
        $appointment = Appointment::find(decrypt($encrypted_appointment_id));

        smilify('success', 'Diagnóstico cargado con éxito.');

        return view('doctor.diagnosis.show', compact('diagnosis', 'appointment', 'prescription'));
    }


    public function printPrescription(Appointment $appointment)//
    {
        // Buscar prescripción por id de la cita
        $prescription = Prescription::with('appointment', 'medicines', 'medicalExams')
                    ->where('appointment_id', $appointment->id)->first();//$appointment->id

        // encontrar paciente
        $patient = Person::find($prescription->appointment->patient_id);

        $fecha = Carbon::now()->format('Y-m-d H:i:s');

        $pdf = PDF::loadView('doctor.diagnosis.previewPrescription', compact('prescription', 'patient', 'fecha'))->setPaper('a4', 'landscape');

        // set font
        $pdf->setOption('defaultFont', 'sans-serif');

        return $pdf->stream('prescripcion.pdf');        
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
