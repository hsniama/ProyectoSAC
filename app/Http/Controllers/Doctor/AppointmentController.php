<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:appointment-list')->only('index');
    }

    public function index(Request $request)
    {
        $pendingAppointments = Appointment::with('patient', 'doctor')
                            ->where('doctor_id', auth()->user()->person->id)
                            ->where('status', 'Pendiente');                
        
        // Aplicacion de filtros de busqueda entre fechas
        if($request->start_date && $request->end_date){
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay(); 

            $pendingAppointments->whereBetween('scheduled_date', [$start_date, $end_date]);
        }else{
            // Por defecto, mostrar solo las citas de hoy
            $today = Carbon::now()->startOfDay();
            $pendingAppointments->where('scheduled_date', $today);
        }


        $pendingAppointments = $pendingAppointments->get();
        

        if($request->ajax()){
            return DataTables::of($pendingAppointments)
                ->addColumn('scheduled_date', function($pendingAppointment){
                    return Carbon::parse($pendingAppointment->scheduled_date)->format('Y-m-d');
                })
                ->addColumn('scheduled_time', function($pendingAppointment){
                    return $pendingAppointment->getScheduledTimeAttribute($pendingAppointment->scheduled_time);
                })
                ->addColumn('speciality', function($pendingAppointment){
                    return Speciality::find($pendingAppointment->speciality_id)->name;
                })
                ->addColumn('patient', function($pendingAppointment){
                    return $pendingAppointment->patient->nombres . ' ' . $pendingAppointment->patient->apellidos;
                })
                ->addColumn('age', function($pendingAppointment){
                    return Carbon::parse($pendingAppointment->patient->fecha_nacimiento)->age;
                })
                ->addColumn('actions', function($pendingAppointment){
                    $botones = '';

                    if(auth()->user()->can('diagnostico-create')){
                    $botones .= '<a href="'. route('doctor.diagnosis.create', encrypt($pendingAppointment->id)) .'" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Iniciar Consulta">
                                    <i class="fa-solid fa-circle-plus fa-xl" style="color: #47e04e;"></i>
                                </a>';
                    }
                  
                    // si el paciente ya ha tenido citas medicas con el estado de "Atendido", se le permite ver su historial medico
                    $tieneCitasAtendidas = Appointment::where('patient_id', $pendingAppointment->patient_id)
                                                    ->where('status', 'Atendido')
                                                    ->count();

                                                    
                    if(auth()->user()->can('diagnostico-show') && $tieneCitasAtendidas > 0){
                        $botones .= '<a class="ml-2 mr-2" href="'. route('doctor.diagnosis.medicalHistories', encrypt($pendingAppointment->patient_id)) .'" target="_blank" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Ver Historial Médico">
                            <i class="fa-solid fa-clock-rotate-left fa-xl" style="color: #246dff;"></i>
                        </a>';
                    }

                    return $botones;                
                    
                })
                ->rawColumns(['scheduled_date', 'scheduled_time', 'speciality', 'patient', 'age', 'actions'])
                ->make(true);
        }

        return view('doctor.citas.index');
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
