<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
use App\Models\Speciality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::create([
            'name' => 'Medicina Interna',
            'description' => 'La medicina interna es la especialidad médica que se ocupa del diagnóstico y tratamiento de las enfermedades que afectan a los órganos internos del cuerpo humano.',
            'status' => 'Inactivo',
            'created_by' => 'Henry Niama',
            'updated_by' => 'Henry Niama',
        ]);

        Speciality::create([
            'name' => 'Pediatría',
            'description' => 'La pediatría es la especialidad médica que se ocupa del estudio, diagnóstico y tratamiento de las enfermedades que afectan a los niños.',
            'status' => 'Inactivo',
            'created_by' => 'John Travolta',
            'updated_by' => 'Pepe Aguilar',
        ]);

        // Create five specialities.
        Speciality::create([
            'name' => 'Endocrinología',
            'description' => 'La endocrinología es la especialidad médica que se ocupa del estudio, diagnóstico y tratamiento de las enfermedades del sistema endocrino.',
            'status' => 'Inactivo',
            'created_by' => fake()->name(),
            'updated_by' => fake()->name(),
        ]);

        Speciality::create([
            'name' => 'Ginecología',
            'description' => 'La ginecología es la especialidad médica que se ocupa del estudio, diagnóstico y tratamiento de las enfermedades que afectan a las mujeres.',
            'status' => 'Inactivo',
            'created_by' => fake()->name(),
            'updated_by' => fake()->name(),
        ]);

        Speciality::create([
            'name' => 'Oftalmología',
            'description' => 'La oftalmología es la especialidad médica que se ocupa del estudio, diagnóstico y tratamiento de las enfermedades que afectan a los ojos.',
            'status' => 'Inactivo',
            'created_by' => fake()->name(),
            'updated_by' => fake()->name(),
        ]);


        // Creo 5 mas elementos random.
        //Speciality::factory()->count(5)->create();  
        
  
    }
}
