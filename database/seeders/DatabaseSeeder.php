<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Roles y permisos base establecidos.
        $this->call(RoleSeeder::class);

        // Usuarios base
        $this->call(UserSeeder::class);

        // Llenar automaticamente 10 usuarios random con factory.
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('paciente');
        });

        // $this->call([
        //     RoleSeeder::class,
        //     UserSeeder::class,
        //     PersonaSeeder::class,
        //     CitaSeeder::class,
        //     ConsultaSeeder::class,
        //     RecetaSeeder::class,
        //     DiagnosticoSeeder::class,
        //     DetalleRecetaSeeder::class,
        //     DetalleDiagnosticoSeeder::class,
        // ]);
    
    }
}
