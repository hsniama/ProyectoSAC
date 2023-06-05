<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Symptom;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 symptoms
        Symptom::create(['name' => 'Fiebre']);
        Symptom::create(['name' => 'Tos seca']);
        Symptom::create(['name' => 'Cansancio']);
        Symptom::create(['name' => 'Dolor de garganta']);
        Symptom::create(['name' => 'Diarrea']);
        Symptom::create(['name' => 'Conjuntivitis']);
        Symptom::create(['name' => 'Dolor de cabeza']);
        Symptom::create(['name' => 'Pérdida del sentido del olfato']);
        Symptom::create(['name' => 'Pérdida del sentido del gusto']);
        Symptom::create(['name' => 'Erupciones cutáneas']);
        Symptom::create(['name' => 'Dificultad para respirar']);
        Symptom::create(['name' => 'Dolor o presión en el pecho']);
        Symptom::create(['name' => 'Incapacidad para hablar o moverse']);
        Symptom::create(['name' => 'Otro']);
        Symptom::create(['name' => 'Ninguno']);

        // Symptom::factory()->count(10)->create();
    }
}
