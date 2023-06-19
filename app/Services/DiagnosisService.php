<?php
namespace App\Services;

use App\Models\Diagnosis;
use App\Models\VitalSign;
use App\Models\Prescription;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Requests\UpdateVitalSignRequest;
use App\Http\Requests\StorePrescriptionRequest;


class DiagnosisService
{

    public function updateSignVitals(UpdateVitalSignRequest $updateVitalSignRequest): VitalSign
    {
        $vitalSign = VitalSign::where('appointment_id', $updateVitalSignRequest->appointment_id)->first();
        $vitalSign->update($updateVitalSignRequest->validated());
        $vitalSign->updated_by = auth()->user()->person->getFullNameAttribute();
        $vitalSign->status = 'Llenada';
        if(!isset($vitalSign->created_by )){
            $vitalSign->created_by = auth()->user()->person->getFullNameAttribute();
        }
        $vitalSign->updated_by = auth()->user()->person->getFullNameAttribute();
        $vitalSign->save();

        return $vitalSign;
    }

    public function createDiagnosis(StoreDiagnosisRequest $request): Diagnosis
    {
        // $diagnosis = Diagnosis::create($request->except('current_diseases', 'possiblediseases', 'symptoms'));
        $diagnosis = Diagnosis::create([
            'appointment_id' => $request->appointment_id,
            'allergies' => $request->allergies,
            'drug_use' => $request->drug_use,
            'alcohol_use' => $request->alcohol_use,
            'smoking_use' => $request->smoking_use,
            'family_background' => $request->family_background,
            'surgical_history' => $request->surgical_history,
            'current_medication' => $request->current_medication,
            'reason_for_consultation' => $request->reason_for_consultation,
            'conclusions' => $request->conclusions,
        ]);

        // Tabla intermedia:diagnosis_disease Actual
        $currentDiseases = $request->current_diseases;
        if(isset($currentDiseases) ){
            foreach ($currentDiseases as $currentDisease) {
                $diagnosis->diseases()->attach($currentDisease['id'], [
                    'duration' => $currentDisease['duration'],
                    'notes' => $currentDisease['notes'],
                    'status' => $currentDisease['status'],
                ]);
            }
        }


        // Tabla intermedia:diagnosis_disease Posible
        $possibleDiseases = $request->possiblediseases;
        
        if(isset($possibleDiseases) ){
            foreach ($possibleDiseases as $possibleDisease) {
                $diagnosis->diseases()->attach($possibleDisease['id'], [
                    'notes' => $possibleDisease['notes'],
                    'status' => $possibleDisease['status'],
                    'probability' => $possibleDisease['probability'],
                ]);
            }
        }

        // Tabla intermedia:diagnosis_symptom
        $symptoms = $request->symptoms;
        if(isset($symptoms) ){
            foreach ($symptoms as $symptom) {
                $diagnosis->symptoms()->attach($symptom['id'], [
                    'duration' => $symptom['duration'],
                    'notes' => $symptom['notes'],
                ]);
            }
        }


        return $diagnosis;
    }

    public function createPrescription(StorePrescriptionRequest $prescriptionRequest) : Prescription
    {
        $recommendations = implode("\n", $prescriptionRequest->recommendationsPrescription);

        $prescription = Prescription::create([
            'appointment_id' => $prescriptionRequest->appointment_id,
            'recommendations' => $recommendations,
        ]);

        // Tabla intermedia:medicine_prescription
        $medicines = $prescriptionRequest->medicines;
        if(isset($medicines) ){
            foreach ($medicines as $medicine) {
                $prescription->medicines()->attach($medicine['id'], [
                    'quantity' => $medicine['quantity'],
                    'duration' => $medicine['duration'],
                    'observations' => $medicine['observations'],
                ]);
            }
        }

        // Tabla intermedia:medical_exam_prescription
        $exams = $prescriptionRequest->exams;
        if(isset($exams) ){
            foreach ($exams as $exam) {
                $prescription->medicalExams()->attach($exam['id'], [
                    'observations' => $exam['observations'],
                ]);
            }
        }

        return $prescription;
    }
    
}

?>