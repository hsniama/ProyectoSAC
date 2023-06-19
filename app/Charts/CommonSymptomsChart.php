<?php

namespace App\Charts;


use App\Models\Diagnosis;
use ArielMejiaDev\LarapexCharts\LarapexChart;


class CommonSymptomsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {

        //get the common symptoms of the disease COVID-19:
        // $commonSymptoms = Disease::where('name', 'COVID-19')->first()->symptoms;
        $commonSymptoms = Diagnosis::with('symptoms')->whereHas('diseases', function($query){
            $query->where('name', 'COVID-19');
        })->get()->pluck('symptoms')->flatten()->unique('name')->pluck('name')->toArray();

        // dd($commonSymptoms);


        //Now get the amount of patients in % that have each symptom:
        $amountOfPatientsWithSymptom = [];

        foreach($commonSymptoms as $symptom){
            $amountOfPatientsWithSymptom[] = Diagnosis::whereHas('diseases', function($query){
                $query->where('name', 'COVID-19');
            })->whereHas('symptoms', function($query) use ($symptom){
                $query->where('name', $symptom);
            })->count();
        }

        //Convert the array to values in %:
        $amountOfPatientsWithSymptom = array_map(function($value) use ($amountOfPatientsWithSymptom){
            return round(($value * 100) / array_sum($amountOfPatientsWithSymptom), 2);
        }, $amountOfPatientsWithSymptom);

        // dd($amountOfPatientsWithSymptom);

        return $this->chart->horizontalBarChart()
            ->setTitle('Síntomas de COVID-19 más comunes.')
            ->setSubtitle('Se muestra el porcentaje de pacientes que tienen cada síntoma.')
            ->setColors(['#FFC107'])
            ->addData('%', $amountOfPatientsWithSymptom)
            ->setXAxis($commonSymptoms);
    }
}
