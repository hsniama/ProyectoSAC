<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\SpecialitySeeder;

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
            // CitaSeeder::class,
            // ConsultaSeeder::class,
            // RecetaSeeder::class,
            // DiagnosticoSeeder::class,
            // DetalleRecetaSeeder::class,
            // DetalleDiagnosticoSeeder::class,
        ]);


    
    }
}
