<?php

namespace App\Http\Controllers\API;

use App\Models\Survey;
use App\Models\Disease;
use App\Models\Diagnosis;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChartsController extends Controller
{
    public function covidChartByYear(Request $request)
    {
        $year = $request->input('year', date('Y'));

        //  Get the unique months from the diagnoses table in an array:
        $months = Diagnosis::whereHas('diseases', function($query){
            $query->where('name', 'COVID-19');
        })->whereYear('created_at', $year)
                            ->selectRaw('MONTH(created_at) month')
                            ->groupBy('month')
                            ->orderBy('month', 'asc')
                            ->pluck('month')
                            ->toArray( );

            //map the months to their names:
            $months = array_map(function($month){
                return date('F', mktime(0, 0, 0, $month, 1));
            }, $months);


        //  Get the number of cases per month:
        $cases = Diagnosis::join('diagnosis_disease', 'diagnoses.id', '=', 'diagnosis_disease.diagnosis_id')
            ->join('diseases', 'diagnosis_disease.disease_id', '=', 'diseases.id')
            ->where('diseases.name', 'COVID-19')
            ->whereYear('diagnoses.created_at', $year)
            ->selectRaw('MONTH(diagnoses.created_at) AS month, COUNT(*) AS cases')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('cases') // comentar este y descomentar el get() para obtener los meses
            ->toArray(); // comentar este y descomentar el get() para obtener los meses
            // ->get();

        

        return response()->json([
            'months' => $months,
            'cases' => $cases,
        ]);
    }

    public function doctorCalification(Request $request)
    {

        $doctorId = $request->input('doctorId');

        $buena = Appointment::with('survey')
                    ->whereHas('survey', function($query){
                        $query->where('doctor_qualification', '=', 'Buena');
                    })->select('doctor_id', \DB::raw('count(*) as total'))
                    ->groupBy('doctor_id')
                    ->orderBy('total', 'desc')
                    ->get()
                    ->pluck('total', 'doctor_id')
                    ->toArray();
  
        $regular = Appointment::with('survey')
                    ->whereHas('survey', function($query){
                        $query->where('doctor_qualification', '=', 'Regular');
                    })->select('doctor_id', \DB::raw('count(*) as total'))
                    ->groupBy('doctor_id')
                    ->orderBy('total', 'desc')
                    ->get()
                    ->pluck('total', 'doctor_id')
                    ->toArray();

        $mala = Appointment::with('survey')
                    ->whereHas('survey', function($query){
                        $query->where('doctor_qualification', '=', 'Mala');
                    })->select('doctor_id', \DB::raw('count(*) as total'))
                    ->groupBy('doctor_id')
                    ->orderBy('total', 'desc')
                    ->get()
                    ->pluck('total', 'doctor_id')
                    ->toArray();      

        
        //create an array with the data > 0
        $data = [];
        $labels = [];

        if($buena[$doctorId]> 0){
            $labels[] = 'Buena';
            $data[] = $buena[$doctorId];
        }
        if($regular[$doctorId] > 0){
            $labels[] = 'Regular';
            $data[] = $regular[$doctorId];
        }
        if($mala[$doctorId] > 0){
            $labels[] = 'Mala';
            $data[] = $mala[$doctorId];
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);

    }
}
