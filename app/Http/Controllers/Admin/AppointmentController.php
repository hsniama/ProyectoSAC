<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use App\Models\Persona;
use App\Models\Speciality;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Controllers\Controller; // yo agregue esta


class AppointmentController extends Controller
{

    public function __construct(){
        $this->middleware('can:appointment-list')->only('index');
        $this->middleware('can:appointment-create')->only('create', 'store');
        $this->middleware('can:appointment-edit')->only('edit', 'update');
        $this->middleware('can:appointment-delete')->only('destroy');
        $this->middleware('can:appointment-show')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$appointments = Appointment::all();

        $appointments = Appointment::with('patient', 'doctor', 'speciality')->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Persona::whereHas('user.roles', function($query){
            $query->where('name', 'paciente');
        })->get();

        $doctors = Persona::whereHas('user.roles', function($query){
            $query->where('name', 'doctor');
        })->get();

        // Bring the doctors that have specialities
        $doctors = Persona::whereHas('specialities')->get();

        $specialities = Speciality::where('status', 'Activo')->get();

        return view('admin.appointments.create', compact('patients', 'doctors', 'specialities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        Appointment::create($request->all());

        return redirect()->route('admin.appointments.index')->with('success', 'La cita se creó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $appointment->load('patient', 'doctor', 'speciality');

        return view('admin.appointments.show', compact('appointment'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {

        // Bring all the specialities that are Activo
        $specialities = Speciality::where('status', 'Activo')->get();
        
        // Look for the patient and doctor
        // $paciente = Persona::find($appointment->patient_id);
        $doctorCita = Persona::find($appointment->doctor_id);

        // Bring the personas that have specialities
        //$doctors = Persona::whereHas('specialities')->get();

        // Bring the doctors that have the same specialities
        $doctors = Persona::whereHas('specialities', function($query) use ($appointment){
            $query->where('speciality_id', $appointment->speciality_id);
        })->get();


        // Look for the patient and retrieve id, nombres, apellidos and cedula:
        $paciente = Persona::where('id', $appointment->patient_id)->select('id', 'nombres', 'apellidos', 'cedula')->first();


        return view('admin.appointments.edit', compact('appointment', 'specialities', 'paciente', 'doctorCita', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        return redirect()->route('admin.appointments.edit', $appointment)->with('success', 'La cita se actualizó con éxito');

        //return redirect()->route('admin.appointments.index')->with('success', 'La cita se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'La cita se eliminó con éxito');
    }

    
}
