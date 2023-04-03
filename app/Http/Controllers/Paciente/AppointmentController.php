<?php

namespace App\Http\Controllers\Paciente;

use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

    }


    public function create()
    {
        $specialities = Speciality::where('status', 'Activo')->get();

        return view('paciente.citas.create', compact('specialities'));
    }


    public function store(StoreAppointmentRequest $request)
    {     

        //validate the telephone and email of the patient
        $rules =[
            'telefono' => 'required|numeric|digits:10',
            'email' => 'required|email'
        ];

        $validator = Validator::make($request->only('telefono', 'email'), $rules);

        // show the validation error messages
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $appointment = Appointment::create($request->all());

        //update the telephone number and email of the patient
        $appointment->patient->update([
            'telefono' => $request->input('telefono')
        ]);

        $appointment->patient->user->update([
            'email' => $request->input('email')
        ]);

        $encrypted_appointment = encrypt($appointment->id);

        // return redirect()->route('paciente.resumen', ['appointment' => $encrypted_appointment])->with('notificacion', 'La cita se ha registrado con éxito');
        return redirect()->route('paciente.resumen', ['appointment' => $encrypted_appointment]);

    }

    public function resumenCita($encrypted_appointment)
    {
        $appointment = Appointment::find(decrypt($encrypted_appointment));

        // $notificacion = session('notificacion');

        notify()->success('Confirmamos que su cita médica ha sido agendada para el día '. $appointment->scheduled_date . ' a las ' . $appointment->scheduled_time . '
                          en la unidad Medica HOSPITAL EL ORO con el Dr. ' . $appointment->doctor->getFullNameAttribute() . ' en el area de ' . $appointment->speciality->name .'.', 
                          'La cita se ha registrado con éxito');

        // return view('paciente.citas.resumen', ['appointment' => $appointment, 'notificacion' => $notificacion]);
        return view('paciente.citas.resumen', ['appointment' => $appointment]);
    }



    public function show(Appointment $appointment, String $notificacion)
    {
        $appointment->load('patient', 'doctor', 'speciality');

        // dd($appointment);
        // return view('paciente.citas.show', compact('notificacion', 'appointment'));

        //use redirect
        return redirect()->route('paciente.citas.show', compact('appointment'));

    }
    

    public function edit(Appointment $appointment)
    {
        //
    }


    public function update(Request $request, Appointment $appointment)
    {
        //
    }


    public function destroy(Appointment $appointment)
    {
        //
    }
}
