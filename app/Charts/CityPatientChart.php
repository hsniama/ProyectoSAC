<?php

namespace App\Charts;

use App\Models\Person;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;


class CityPatientChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        //Obtener la cantidad de pacientes por ciudad de la tabla people del atributo ciudad:
        $pacientesPorCiudad = Person::whereHas('user', function($query){
            $query->role('paciente');
        })->select('ciudad', DB::raw('count(*) as cantidad'))
                            ->groupBy('ciudad')
                            ->get();

        // Obtener los valores de cantidad como un array
        $cantidades = $pacientesPorCiudad->pluck('cantidad')->toArray();

        // dd($cantidades);

        // Obtener un array de las ciudades diferentes, deseo solo los valores:
        $cities = $pacientesPorCiudad->pluck('ciudad')->toArray();
        // \dd($cities);

        return $this->chart->barChart()
            ->setTitle('Pacientes por Ciudades')
            ->setSubtitle('Se muestra la cantidad de pacientes que hay en cada ciudad.')
            ->addData('Cantidad', $cantidades)
            ->setXAxis($cities);
    }
}
