<?php

namespace App\Charts;

use App\Models\Person;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class AgePatientChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        // Obtener la cantidad de pacientes por edad (menores, adultos y tercera edad) de la tabla people del atributo fecha_nacimiento:

        // $menoresDeEdad = Person::whereDate('fecha_nacimiento', '>', Carbon::now()->subYears(18))->count();
        $menoresDeEdad = Person::whereHas('user', function($query){
            $query->role('paciente');
        })->whereDate('fecha_nacimiento', '>', Carbon::now()->subYears(18))->count();

        $adultos = Person::whereHas('user', function($query){
            $query->role('paciente');
        })->whereDate('fecha_nacimiento', '<=', Carbon::now()->subYears(18))->whereDate('fecha_nacimiento', '>', Carbon::now()->subYears(65))->count();

        // $adultos = Person::whereDate('fecha_nacimiento', '<=', Carbon::now()->subYears(18))->whereDate('fecha_nacimiento', '>', Carbon::now()->subYears(65))->count();
        
        $terceraEdad = Person::whereHas('user', function($query){
            $query->role('paciente');
        })->whereDate('fecha_nacimiento', '<=', Carbon::now()->subYears(65))->count();


        // $terceraEdad = Person::whereDate('fecha_nacimiento', '<=', Carbon::now()->subYears(65))->count();



        return $this->chart->donutChart()
        ->setTitle('Pacientes por edad')
        ->setSubtitle('Se muestra la cantidad de pacientes por edad.')
        ->addData([$menoresDeEdad, $adultos, $terceraEdad])
        ->setLabels(['Menores de edad', 'Adultos', 'Tercera edad'])
        ->setColors(['#ff0000', '#00ff00', '#0000ff']);
    }
}
