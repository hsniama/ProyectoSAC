<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Persona;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $idDoctor = Persona::whereHas('user', function($query){
            $query->whereHas('roles', function($query){
                $query->where('name', 'doctor');
            });
        })->inRandomOrder()->first()->id;

        return [
            'patient_id' =>  // Get the first patient
                            Persona::whereHas('user', function($query){
                                $query->whereHas('roles', function($query){
                                $query->where('name', 'paciente');
                            });
                            })->inRandomOrder()->first()->id,
            'doctor_id' =>  $idDoctor,
            'speciality_id' => // Bring the id of a random speciality that belongs to a person with role doctor:
                                // Speciality::whereHas('personas', function($query){
                                //     $query->whereHas('user', function($query){
                                //         $query->whereHas('roles', function($query){
                                //             $query->where('name', 'doctor');
                                //         });
                                //     });
                                // })->inRandomOrder()->first()->id

                                // Bring the id of a random speciality that belongs to a person:
                                //Speciality::whereHas('personas')->inRandomOrder()->first()->id
                                 
                                // Bring the id of the speciality that belongs to the doctor:
                                Persona::find($idDoctor)->specialities()->inRandomOrder()->first()->id
                                ,
                                
            'scheduled_date' => fake()->date(),
            'scheduled_time' => fake()->time(),
            'status' => fake()->randomElement(['Atendido', 'Cancelado', 'Pendiente']),
            'notes' => fake()->paragraph(),
        ];
    }
}
