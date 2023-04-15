<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Person;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function getAppointmentData(Request $request){
        $hora_cita = $request->input('scheduled_date');
        $fecha_cita = $request->input('scheduled_time');
        $speciality_id = $request->input('speciality_id');
        $doctor_id = $request->input('doctor_id');

        $speciality = Speciality::find($speciality_id);
        $doctor = Person::find($doctor_id);

        return response()->json([
            'fecha_cita' => $fecha_cita,
            'hora_cita' => $hora_cita,
            'especialidad_nombre' => $speciality->name,
            'doctor_nombres' => $doctor->nombres,
            'doctor_apellidos' => $doctor->apellidos,
        ]);
    }

    public function cancelAppFromAdmin(Request $request){

        // \dd($request->all());

        $appointment_id = $request->input('appointment_id');

        $appointment = Appointment::find($appointment_id);

        // dd($appointment);

        $appointment->status = 'Cancelada';
        $appointment->notes = $request->input('notes');

        $appointment->save();

        return response()->json([
            'message' => 'Cita cancelada correctamente.',
        ]);
    }

    public function getPatientData($cedula){
        $patient = Person::where('cedula', $cedula)->first();

        // dd($patient);
        $user = User::find($patient->user_id);
        return response()->json([
            'nombres' => $patient->getFullNameAttribute(),
            'edad' => $patient->getAgeAttribute(),
            'telefono' => $patient->telefono,
            'email' => $user->email,
        ]);
    }
}
