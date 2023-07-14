<?php

namespace App\Http\Controllers\Paciente;

use App\Models\Disease;
use App\Models\Diagnosis;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiseaseRequest;
use App\Http\Requests\UpdateDiseaseRequest;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Enfermedades del paciente.
        $diseases = Disease::where('patient_id', auth()->user()->person->id)->get();


        //Enfermedades ya guardadas con relacion: diagnosis_disease
        $patient = auth()->user()->person;

        $appointments = $patient->patientAppointments()->with('diagnosis')->get();

        //Todas, independientemente de su estado
        $diseasesDiagnosis = [];
        foreach ($appointments as $appointment) {
            if ($appointment->diagnosis) {
                $appointment->diagnosis->load('diseases');
                foreach ($appointment->diagnosis->diseases as $disease) {
                    $diseasesDiagnosis[] = $disease;
                }
            }
        }

        return view('paciente.diseases.index', compact('diseases', 'diseasesDiagnosis'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('paciente.diseases.create');
    }


    public function store(StoreDiseaseRequest $request)
    {
        $request->validated();

        Disease::create([
            'patient_id' => auth()->user()->person->id,
            'name' => $request->name,
            'observaciones' => $request->observaciones,
        ]);



        \notify()->success('La enfermedad ha sido creada correctamente.', 'Enfermedad creada');

        return redirect()->route('paciente.diseases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {
        // return view('paciente.diseases.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        $disease->load('diagnosis');
         
        return view('paciente.diseases.edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiseaseRequest  $request
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiseaseRequest $request, Disease $disease)
    {
        $request->validated();

        Disease::where('id', $disease->id)->update([
            'name' => $request->name,
            'observaciones' => $request->observaciones,
        ]);

        \notify()->success('La enfermedad ha sido actualizada correctamente.', 'Enfermedad actualizada');

        return redirect()->route('paciente.diseases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {
        //eliminar registro de tabla intermedia diagnosis_disease donde disease_id = $disease->id
        $disease->delete();


        \notify()->success('La enfermedad ha sido eliminada correctamente.', 'Enfermedad eliminada');

        return redirect()->route('paciente.diseases.index');

    }
}
