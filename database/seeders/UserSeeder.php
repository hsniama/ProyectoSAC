<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
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
        ])->assignRole('super-admin')->person()->save(Person::factory()->make());

        User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('admin')->person()->save(Person::factory()->make());

        User::create([
            'username' => 'gerente',
            'email' => 'gerente@gerente.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('gerente')->person()->save(Person::factory()->make());

        User::create([
            'username' => 'paciente',
            'email' => 'paciente@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('paciente')->person()->save(Person::factory()->make());

        User::create([
            'username' => 'secretaria',
            'email' => 'secretaria@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('secretaria')->person()->save(Person::factory()->make());

        User::create([
            'username' => 'doctor',
            'email' => 'doctor@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('doctor')->person()->save(Person::factory()->make())->specialities()->save(Speciality::factory()->make());

        

        //Llenar automaticamente 40 usuarios pacientes random con factory con relacion a person.
        User::factory(40)->create()->each(function ($user) {
            $user->assignRole('paciente');
            $user->person()->save(Person::factory()->make());
        });

        //Llenar automaticamente 10 usuarios pacientes random con factory con status Inactivo
        User::factory(20)->create()->each(function ($user) {
            $user->assignRole('paciente');
            $user->status = 'Inactivo';
            $user->save();
            $user->person()->save(Person::factory()->make());
            $user->person->save();
        });

                // // Vale muy bien para crear 10 usuarios pacientes con relacion a person
                // User::factory(10)->create()->each(function ($user) {
                //     $user->assignRole('paciente');
                //     Person::factory()->create(['user_id' => $user->id]);
                // });

        //Llenar automaticamente 5 usuarios doctores random con factory con relacion a person sin especialidad.
        // User::factory(5)->create()->each(function ($user) {
        //     $user->assignRole('doctor');
        //     $user->person()->save(Person::factory()->make());
        // });

        // Llenar automaticamente 10 usuarios doctores random con factory con relacion a person y cada person
        // con una especialidad:
        // User::factory(10)->create()->each(function ($user) {
        //     $user->assignRole('doctor');
        //     $user->person()->save(Person::factory()->make());
        //     $user->person->specialities()->save(Speciality::factory()->make());
        // });

        // Llenar automaticamente 10 usuarios doctores random con el prefijo de Dr. con factory con relacion a person y cada person
        // con una especialidad:
        User::factory(20)->create()->each(function ($user) {
            $user->assignRole('doctor');
            $user->person()->save(Person::factory()->make(['nombres' => 'Dr. ']));
            $user->person->specialities()->save(Speciality::factory()->make());
        });
    }
}
