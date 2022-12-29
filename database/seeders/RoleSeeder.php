<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; //Agrego yo de spatie, desde la documentacion
use Spatie\Permission\Models\Permission; //Agrego yo de spatie, desde la documentacion

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* 
        Admin => all permissions, incluido el reprogramar citas.
        secretaria => registrar paciente y generar/imprimir creedenciales, ver citas ya registradas, registrar citas para paciente
        doctor => ver agenda de citas que tiene asignadas, hacer la consulta y llenar campos de la cita.
        paciente => registrarse en el sistema,  agendar citas, ver citas que tiene asignadas
        */
        $admin = Role::create(['name' => 'admin']);
        $secretaria = Role::create(['name' => 'secretaria']);
        $doctor = Role::create(['name' => 'doctor']);
        $paciente = Role::create(['name' => 'paciente']);

        Permission::create(['name' => 'welcome'])->syncRoles([$admin, $secretaria, $doctor, $paciente]);
        Permission::create(['name' => 'home'])->syncRoles([$admin, $secretaria, $doctor, $paciente]);
        Permission::create(['name' => 'admin.personas.create'])->syncRoles([$admin, $secretaria, $paciente]);
        Permission::create(['name' => 'admin.personas.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.personas.store'])->syncRoles([$admin, $secretaria, $paciente]);
        Permission::create(['name' => 'admin.personas.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.personas.destroy'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.personas.index'])->syncRoles([$admin, $secretaria, $doctor, $paciente]);
        Permission::create(['name' => 'admin.personas.show'])->syncRoles([$admin, $secretaria, $doctor, $paciente]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.estadistica'])->syncRoles([$admin]);

    }
}
