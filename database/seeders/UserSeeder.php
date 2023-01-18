<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Persona;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuarios base ya establecidos.

        User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('super-admin')->persona()->save(Persona::factory()->make());

        User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('admin')->persona()->save(Persona::factory()->make());

        User::create([
            'username' => 'gerente',
            'email' => 'gerente@gerente.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('gerente')->persona()->save(Persona::factory()->make());

        User::create([
            'username' => 'paciente',
            'email' => 'paciente@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('paciente')->persona()->save(Persona::factory()->make());

        User::create([
            'username' => 'secretaria',
            'email' => 'secretaria@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('secretaria')->persona()->save(Persona::factory()->make());

        User::create([
            'username' => 'doctor',
            'email' => 'doctor@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('doctor')->persona()->save(Persona::factory()->make());

        

        //Llenar automaticamente 50 usuarios pacientes random con factory con relacion a persona.
        User::factory(100)->create()->each(function ($user) {
            $user->assignRole('paciente');
            $user->persona()->save(Persona::factory()->make());
        });	

                // // Vale muy bien para crear 10 usuarios pacientes con relacion a persona
                // User::factory(10)->create()->each(function ($user) {
                //     $user->assignRole('paciente');
                //     Persona::factory()->create(['user_id' => $user->id]);
                // });

        //Llenar automaticamente 5 usuarios doctores random con factory con relacion a persona sin especialidad.
        // User::factory(5)->create()->each(function ($user) {
        //     $user->assignRole('doctor');
        //     $user->persona()->save(Persona::factory()->make());
        // });	

        // Llenar automaticamente 10 usuarios doctores random con factory con relacion a persona y cada persona
        // con una especialidad:
        // User::factory(10)->create()->each(function ($user) {
        //     $user->assignRole('doctor');
        //     $user->persona()->save(Persona::factory()->make());
        //     $user->persona->specialities()->save(Speciality::factory()->make());
        // });

        // Llenar automaticamente 10 usuarios doctores random con el prefijo de Dr. con factory con relacion a persona y cada persona
        // con una especialidad:
        User::factory(20)->create()->each(function ($user) {
            $user->assignRole('doctor');
            $user->persona()->save(Persona::factory()->make(['nombres' => 'Dr. ']));
            $user->persona->specialities()->save(Speciality::factory()->make());
        });


    }
}
