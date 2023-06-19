<?php

namespace App\Http\Controllers\API;

use App\Models\Diagnosis;
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
        $cases = Diagnosis::whereHas('diseases', function($query){
            $query->where('name', 'COVID-19');
        })->whereYear('created_at', $year)
                            ->selectRaw('MONTH(created_at) month, count(*) as cases')
                            ->groupBy('month')
                            ->orderBy('month', 'asc')
                            ->pluck('cases')
                            ->toArray( );
        

        return response()->json([
            'months' => $months,
            'cases' => $cases,
        ]);
    }
}
