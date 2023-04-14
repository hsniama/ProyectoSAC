<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendingAppointments = Appointment::with('patient', 'doctor', 'speciality')
                            ->where('doctor_id', auth()->user()->person->id)
                            ->where('status', 'Pendiente')
                            ->get();
        
        // $confirmedAppointments = Appointment::with('patient', 'doctor', 'speciality')
        //                     ->where('doctor_id', auth()->user()->person->id)
        //                     ->where('status', 'Confirmado')
        //                     ->get();
        
        // $oldAppointments = Appointment::with('patient', 'doctor', 'speciality')
        //                     ->where('doctor_id', auth()->user()->person->id)
        //                     ->where('status', 'Atendido')
        //                     ->get();

        return view('doctor.citas.index', compact('pendingAppointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
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
}
