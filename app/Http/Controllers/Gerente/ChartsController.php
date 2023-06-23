<?php

namespace App\Http\Controllers\Gerente;

use Charts;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Person;
use App\Models\Diagnosis;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Charts\AgePatientChart;
use App\Charts\CityPatientChart;
use App\Charts\CovidCasesCities;
use App\Charts\GenderPatientChart;
use App\Charts\CommonSymptomsChart;
use App\Http\Controllers\Controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class ChartsController extends Controller
{
    public function getPatientData(AgePatientChart $chartAge, GenderPatientChart $chartGender, CityPatientChart $chartCities)
    {
        
        // https://larapex-charts.netlify.app/2-simple-example/

        return view('gerente.charts.patientData', [
            'chartAge' => $chartAge->build(),
            'chartGender' => $chartGender->build(),
            'chartCities' => $chartCities->build(),
        ]);     
    }

    public function getCovidCasesByYearAndMonth()
    {

        //get the unique years of the created_at column of the diagnosis table:
        $years = Diagnosis::selectRaw('YEAR(created_at) year')
                            ->groupBy('year')
                            ->orderBy('year', 'desc')
                            ->pluck('year')
                            ->toArray();


        return view('gerente.charts.covidCasesByYear', [
            'years' => $years,
        ]);
    }

    public function getCovidCasesByCity(CovidCasesCities $chartCasesCities)
    {
        return view('gerente.charts.covidCasesByCity', [
            'chartCasesCities' => $chartCasesCities->build(),
        ]);
    }

    public function getCovidCommonSymptoms(CommonSymptomsChart $chartSymptoms)
    {
        return view('gerente.charts.covidCommonSymptoms', [
            'chartSymptoms' => $chartSymptoms->build(),
        ]);
    }

    public function getBestDoctors()
    {
        // $doctors = User::doctors()->get();
        // bring the doctor that 

        return view('gerente.charts.bestDoctors', [
            'doctors' => $doctors,
        ]);
    }
}
