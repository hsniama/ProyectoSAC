<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use App\Models\Person;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // yo agregue esta

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:modulo-reportes');
    }

    public function especialidadCita()
    {
        // $specialityCount = Appointment::specialityCount()->get('speciality_id', 'total', 'name');
        $specialityCount = Appointment::selectRaw('speciality_id, count(*) as total')
            ->with('speciality')
            ->groupBy('speciality_id')
            ->get('speciality_id', 'total', 'name');

        // get the amount of appointments with satus Atendido per speciality:
        $specialityCountAtendido = Appointment::selectRaw('speciality_id, count(*) as total')
            ->where('status', 'Atendido')
            ->groupBy('speciality_id')
            ->get('speciality_id', 'total');

        $specialityCountCancelado = Appointment::selectRaw('speciality_id, count(*) as total')
            ->where('status', 'Cancelado')
            ->groupBy('speciality_id')
            ->get('speciality_id', 'total');

        $specialityCountPendiente = Appointment::selectRaw('speciality_id, count(*) as total')
            ->where('status', 'Pendiente')
            ->groupBy('speciality_id')
            ->get('speciality_id', 'total');

        // Create an array that stores the amount of Atendido, Cancelado and Pendiente appointments per speciality:
        $specialitywithAppointments = array();


        foreach ($specialityCount as $sT) {
            $specialitywithAppointments[$sT->speciality->name]['total'] = $sT->total;

            foreach ($specialityCountCancelado as $sC) {
                if ($sT->speciality_id == $sC->speciality_id) {
                    $specialitywithAppointments[$sT->speciality->name]['cancelado']= $sC->total;
                }
            }

            foreach ($specialityCountPendiente as $sP) {
                if ($sT->speciality_id == $sP->speciality_id) {
                    $specialitywithAppointments[$sT->speciality->name]['pendiente']= $sP->total;
                }
            }

            foreach ($specialityCountAtendido as $sA) {
                if ($sT->speciality_id == $sA->speciality_id) {
                    $specialitywithAppointments[$sT->speciality->name]['atendido']= $sA->total;
                }
            }
        }
        

        //  dd($specialitywithAppointments);

        return view('admin.reports.especialidadCita', compact('specialitywithAppointments'));
    }



    public function doctorCita()
    {

        // Get the amount of appointments per doctor:
        // $doctorCount = Appointment::doctorCount()->get('doctor_id', 'total');
        $doctorCount = Appointment::selectRaw('doctor_id, count(*) as total')
            ->with('doctor')
            ->groupBy('doctor_id')
            ->get('doctor_id', 'total');


        // dd($doctorCount);

        // get the amount of appointments with satus Atendido per doctor:
        $doctorCountAtendido = Appointment::selectRaw('doctor_id, count(*) as total')
            ->where('status', 'Atendido')
            ->groupBy('doctor_id')
            ->get('doctor_id', 'total');

        $doctorCountCancelado = Appointment::selectRaw('doctor_id, count(*) as total')
            ->where('status', 'Cancelado')
            ->groupBy('doctor_id')
            ->get('doctor_id', 'total');

        $doctorCountPendiente = Appointment::selectRaw('doctor_id, count(*) as total')
            ->where('status', 'Pendiente')
            ->groupBy('doctor_id')
            ->get('doctor_id', 'total');
    
        
        $doctorwithAppointments = array();

        foreach ($doctorCount as $dT) {
                $doctorwithAppointments[$dT->doctor->nombres . ' ' . $dT->doctor->apellidos]['total'] = $dT->total;
    
            foreach ($doctorCountCancelado as $dC) {
                if ($dT->doctor_id == $dC->doctor_id) {
                    $doctorwithAppointments[$dT->doctor->nombres . ' ' . $dT->doctor->apellidos]['cancelado']= $dC->total;
                }
            }
    
            foreach ($doctorCountPendiente as $dP) {
                if ($dT->doctor_id == $dP->doctor_id) {
                    $doctorwithAppointments[$dT->doctor->nombres . ' ' . $dT->doctor->apellidos]['pendiente']= $dP->total;
                }
            }
    
            foreach ($doctorCountAtendido as $dA) {
                if ($dT->doctor_id == $dA->doctor_id) {
                    $doctorwithAppointments[$dT->doctor->nombres . ' ' . $dT->doctor->apellidos]['atendido']= $dA->total;
                }
            }
        }

        //dd($doctorwithAppointments);


        return view('admin.reports.doctorCita', compact('doctorwithAppointments'));
    }


    public function mesCita(Request $request)
    {
        // get the amount of appointments per month and year:
        $monthYearCount = Appointment::selectRaw('month(scheduled_date) as month, year(scheduled_date) as year, count(*) as total')
            ->groupBy('month', 'year')
            ->get('month', 'total', 'year');

        // dd($monthYearCount);

        // get the amount of appointments with status Atendido per month and year:
        $monthCountAtendido = Appointment::selectRaw('month(scheduled_date) as month, year(scheduled_date) as year, count(*) as total')
            ->where('status', 'Atendido')
            ->groupBy('month', 'year')
            ->get('month', 'total', 'year');


        // get the amount of appointments with status Cancelado per month:
        $monthCountCancelado = Appointment::selectRaw('month(scheduled_date) as month, year(scheduled_date) as year, count(*) as total')
            ->where('status', 'Cancelado')
            ->groupBy('month', 'year')
            ->get('month', 'total', 'year');

        // get the amount of appointments with status Pendiente per month:

        $monthCountPendiente = Appointment::selectRaw('month(scheduled_date) as month, year(scheduled_date) as year, count(*) as total')
            ->where('status', 'Pendiente')
            ->groupBy('month', 'year')
            ->get('month', 'total', 'year');

        // dd($monthCountPendiente);

        // Create an array that stores the amount of Atendido, Cancelado and Pendiente appointments per month and year:
        $monthwithAppointments = array();

        //create array with all the months of the year:
        $months = array(
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        );

        $i =0;

        // store the amount of appointments per month and year in the array:
        foreach ($monthYearCount as $mY) {
            // $monthwithAppointments[$months[$mY->month] . ' ' . $mY->year]['total'] = $mY->total;

            $monthwithAppointments[$i]['month'] = $months[$mY->month];
            $monthwithAppointments[$i]['year'] = $mY->year;
            $monthwithAppointments[$i]['total'] = $mY->total;

            foreach ($monthCountAtendido as $mA) {
                if ($mY->month == $mA->month && $mY->year == $mA->year) {
                    // $monthwithAppointments[$months[$mY->month] . ' ' . $mY->year]['atendido'] = $mA->total;

                    $monthwithAppointments[$i]['atendido'] = $mA->total;
                }
            }

            foreach ($monthCountCancelado as $mC) {
                if ($mY->month == $mC->month && $mY->year == $mC->year) {
                    // $monthwithAppointments[$months[$mY->month] . ' ' . $mY->year]['cancelado'] = $mC->total;

                    $monthwithAppointments[$i]['cancelado'] = $mC->total;
                }
            }

            foreach ($monthCountPendiente as $mP) {
                if ($mY->month == $mP->month && $mY->year == $mP->year) {
                    // $monthwithAppointments[$months[$mY->month] . ' ' . $mY->year]['pendiente'] = $mP->total;

                    $monthwithAppointments[$i]['pendiente'] = $mP->total;
                }
            }

            $i++;
        }


        // dd($monthwithAppointments);

        // bring the years  of the appointments
        $years = Appointment::selectRaw('YEAR(scheduled_date) as year')->groupBy('year')->get();


        return view('admin.reports.mesCita', compact('monthwithAppointments', 'years'));
    }


    public function anoCita()
    {
        // Get the amount of appointments per year:
        $yearCount = Appointment::selectRaw('year(scheduled_date) as year, count(*) as total')
            ->groupBy('year')
            ->get();

        // get the amount of appointments with status Atendido per year:
        $yearCountAtendido = Appointment::selectRaw('year(scheduled_date) as year, count(*) as total')
            ->where('status', 'Atendido')
            ->groupBy('year')
            ->get();

        // get the amount of appointments with status Cancelado per year:
        $yearCountCancelado = Appointment::selectRaw('year(scheduled_date) as year, count(*) as total')
            ->where('status', 'Cancelado')
            ->groupBy('year')
            ->get();

        // get the amount of appointments with status Pendiente per year:

        $yearCountPendiente = Appointment::selectRaw('year(scheduled_date) as year, count(*) as total')
            ->where('status', 'Pendiente')
            ->groupBy('year')
            ->get();
        
        // Create an array that stores the amount of Atendido, Cancelado and Pendiente appointments per year:
        $yearwithAppointments = array();


        foreach ($yearCount as $yT) {
            $yearwithAppointments[$yT->year]['total'] = $yT->total;

            foreach ($yearCountCancelado as $yC) {
                if ($yT->year == $yC->year) {
                    $yearwithAppointments[$yT->year]['cancelado'] = $yC->total;
                }
            }

            foreach ($yearCountPendiente as $yP) {
                if ($yT->year == $yP->year) {
                    $yearwithAppointments[$yT->year]['pendiente'] = $yP->total;
                }
            }

            foreach ($yearCountAtendido as $yA) {
                if ($yT->year == $yA->year) {
                    $yearwithAppointments[$yT->year]['atendido'] = $yA->total;
                }
            }
        }


        // dd($yearwithAppointments);

        return view('admin.reports.anoCita', compact('yearwithAppointments'));
    }
}
