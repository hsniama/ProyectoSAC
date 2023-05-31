<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Person;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\DiseaseSeeder;
use Database\Seeders\SymptomSeeder;
use Database\Seeders\MedicineSeeder;
use Database\Seeders\ScheduleSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\SpecialitySeeder;
use Database\Seeders\AppointmentSeeder;
use Database\Seeders\MedicalExamSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            SpecialitySeeder::class,
            AppointmentSeeder::class,
            ScheduleSeeder::class,
            DiseaseSeeder::class,
            SymptomSeeder::class,
            MedicalExamSeeder::class,
            MedicineSeeder::class,
        ]);
    }
}
