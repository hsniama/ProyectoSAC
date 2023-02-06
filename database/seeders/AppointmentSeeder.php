<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::factory()->count(10)->create();

    }
}
