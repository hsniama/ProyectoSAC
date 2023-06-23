<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Person;
use App\Models\Diagnosis;
use App\Models\VitalSign;
use App\Models\Speciality;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppointmentSeeder extends Seeder
{

    public function run()
    {
        Appointment::factory()->count(30)->create([
            'status' => 'Atendido'
        ])->each(function ($appointment) {

            $randomYear = mt_rand(2020, 2023);
            $randomDate = Carbon::create($randomYear, mt_rand(1, 12), mt_rand(1, 28), mt_rand(0, 23), mt_rand(0, 59), mt_rand(0, 59));

            $diagnosis = Diagnosis::factory()->create([
                'created_at' =>  $randomDate,
                'updated_at' =>  $randomDate,
            ]);

            $diagnosis->diseases()->attach(rand(1, 55), [
                'duration' => fake()->randomElement(['year<1', '1<year<5', 'year>5', 'nacimiento']),
                'status' => 'Enfermedad Actual',
                'notes' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'created_at' =>  $randomDate,
                'updated_at' =>  $randomDate,
            ]);

            $diagnosis->diseases()->attach(rand(1, 55), [
                'status' => 'Enfermedad Posible',
                'probability' => fake()->randomElement(['Alta', 'Media', 'Baja']),
                'notes' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'created_at' =>  $randomDate,
                'updated_at' =>  $randomDate,
            ]);

            $diagnosis->symptoms()->attach(rand(1, 15), [
                'duration' => fake()->randomElement(['week<1', 'month<1', 'month>5', 'always']),
                'notes' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'created_at' =>  $randomDate,
                'updated_at' =>  $randomDate,
            ]);

            $appointment->diagnosis()->save($diagnosis);


            
            $prescription = Prescription::factory()->create([
                'created_at' =>  $randomDate,
                'updated_at' =>  $randomDate,
            ]);

            $prescription->medicalExams()->attach(rand(1, 35), [
                'observations' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'created_at' =>  $randomDate,
                'updated_at' =>  $randomDate,
            ]);

            $prescription->medicines()->attach(rand(1, 25), [
                'quantity' => fake()->randomElement(['1', '2', '3', '4', '5']),
                'duration' => fake()->randomElement(['1', '5', '10', '15', '20', '30']),
                'observations' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'created_at' =>  $randomDate,
                'updated_at' =>  $randomDate,
            ]);

            $appointment->prescription()->save($prescription);
        });


        Appointment::factory(2)->create()->each(function ($appointment) {
            $appointment->status = 'Pendiente';
            $appointment->scheduled_date = now()->addDays(5)->format('Y-m-d');
            $appointment->vitalSign()->save(VitalSign::factory()->make( ['appointment_id' => $appointment->id]));
            $appointment->save();
        });

        Appointment::factory(5)->create()->each(function ($appointment) {
            $appointment->status = 'Pendiente';
            $appointment->scheduled_date = now()->addDays(7)->format('Y-m-d');
            $appointment->vitalSign()->save(VitalSign::factory()->make( ['appointment_id' => $appointment->id]));
            $appointment->save();
        });

        Appointment::factory(3)->create()->each(function ($appointment) {
            $appointment->status = 'Pendiente';
            $appointment->scheduled_date = now()->addDays(10)->format('Y-m-d');
            $appointment->vitalSign()->save(VitalSign::factory()->make( ['appointment_id' => $appointment->id]));
            $appointment->save();
        });

        Appointment::factory(2)->create()->each(function ($appointment) {
            $appointment->status = 'Cancelada';
            $appointment->scheduled_date = now()->addDays(5)->format('Y-m-d');
            $appointment->vitalSign()->save(VitalSign::factory()->make( ['appointment_id' => $appointment->id]));
            $appointment->save();
        });

        Appointment::factory(5)->create()->each(function ($appointment) {
            $appointment->status = 'Cancelada';
            $appointment->scheduled_date = now()->subDays(7)->format('Y-m-d');
            $appointment->vitalSign()->save(VitalSign::factory()->make( ['appointment_id' => $appointment->id]));
            $appointment->save();
        });
    }
}
