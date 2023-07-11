<?php

namespace App\Charts;

use App\Models\User;
use App\Models\Person;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BestDoctorsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {

        $best5Doctors = Appointment::with('survey')
                    ->whereHas('survey', function($query){
                        $query->where('doctor_qualification', '=', 'Buena');
                    })->select('doctor_id', \DB::raw('count(*) as total'))
                    ->groupBy('doctor_id')
                    ->orderBy('total', 'desc')
                    ->take(5)
                    ->get()
                    ->pluck('total', 'doctor_id')
                    ->toArray();
                    
        // dd($best5Doctors);

        // array with the names of each doctor in the top 5:
        $best5DoctorsIds = array_keys($best5Doctors);
        $doctorsNames = [];

        if (is_array($best5DoctorsIds) && count($best5DoctorsIds) > 0) {
            $doctors = Person::whereIn('id', $best5DoctorsIds)->get();
            
            foreach ($doctors as $doctor) {
                $doctorsNames[] = $doctor->getFullNameAttribute();
            }
        }


        return $this->chart->horizontalBarChart()
            ->setTitle('Los 5 Mejores Médicos con buenas calificaciones.')
            ->setSubtitle('Estos médicos tienen las mejores calificaciones en sus consultas.')
            ->setColors(['#2BBA8F'])
            ->addData('Número de buenas reseñas', array_values($best5Doctors))
            ->setXAxis($doctorsNames);
    }
}
