<?php

namespace App\Charts;

use App\Models\Person;
use App\Models\Diagnosis;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CovidCasesCities
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {


        // Get the unique cities from the people table in an array:
        $cities = Person::whereHas('user', function($query){
            $query->role('paciente');
        })->select('ciudad', DB::raw('count(*) as cantidad'))
                            ->groupBy('ciudad')
                            ->get();

        // Obtener un array de las ciudades diferentes, deseo solo los valores:
        $cities = $cities->pluck('ciudad')->toArray();
        
        // \dd($cities);


        // Ahora traeme los casos de COVID-19 por ciudad:
        $cases = Person::whereHas('user', function($query){
            $query->role('paciente');
        })->whereHas('patientAppointments', function($query){
            $query->whereHas('diagnosis', function($query){
                $query->whereHas('diseases', function($query){
                    $query->where('name', 'COVID-19');
                });
            });
        })->select('ciudad', DB::raw('count(*) as cantidad'))
                            ->groupBy('ciudad')
                            ->get();

        // Obtener un array de las cantidades de casos por ciudad:
        $cases = $cases->pluck('cantidad')->toArray();

        // dd($cases);

        return $this->chart->barChart()
            ->setTitle('Casos de Covid por Ciudad')
            ->setSubtitle('Se muestra la cantidad de casos de COVID-19 en cada ciudad')
            ->addData('Cantidad', $cases)
            ->setXAxis($cities)
            ->setColors(['#ff00ff'])
            ->setLabels(['Casos de COVID-19', 'Ciudades'])
            ->setGrid('#3F51B5', 0.1);
    }
}
