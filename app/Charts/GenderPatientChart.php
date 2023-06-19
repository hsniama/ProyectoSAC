<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Person;


class GenderPatientChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        //Obtener la cantidad de paciente por genero (Masculino, Femenino y Otro) de la tabla people del atributo genero:
        
        $masculino = Person::whereHas('user', function($query){
            $query->role('Paciente');
        })->where('genero', 'Masculino')->count();
        
        // $masculino = Person::where('genero', 'Masculino')->count();

        $femenino = Person::whereHas('user', function($query){
            $query->role('Paciente');
        })->where('genero', 'Femenino')->count();

        // $femenino = Person::where('genero', 'Femenino')->count();

        $otro = Person::whereHas('user', function($query){
            $query->role('Paciente');
        })->where('genero', 'Otro')->count();

        // $otro = Person::where('genero', 'Otro')->count();



        return $this->chart->pieChart()
            ->setTitle('Pacientes por genero')
            ->setSubtitle('Se muestra la cantidad de pacientes por genero.')
            ->addData([$masculino, $femenino, $otro])
            ->setLabels(['Masculino', 'Fememenino', 'Otro']);
;
    }
}
