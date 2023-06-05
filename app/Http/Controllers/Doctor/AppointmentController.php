<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:appointment-list')->only('index');
    }

    public function index()
    {
        $pendingAppointments = Appointment::with('patient', 'doctor')
                            ->where('doctor_id', auth()->user()->person->id)
                            ->where('status', 'Pendiente')
                            ->get();                   
        
        return view('doctor.citas.index', compact('pendingAppointments'));
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Appointment $appointment)
    {
        //
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
