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
        gerente => todos los modulos y permisos ademas del modulo de estadisticas de salud. 
        admin => todos los modulos y permisos.
        secretaria => acceso al modulo de gestion de citas. Registrar paciente y generar/imprimir creedenciales, ver citas ya registradas, registrar citas para paciente
        doctor => acceso al modulo de visualizacion de citas por parte del medico. ver agenda de citas que tiene asignadas, hacer la consulta y llenar campos de la cita.
        paciente => acceso al modulo de gestion de registro de linea. registrarse en el sistema,  agendar citas, ver citas que tiene asignadas
        */
        $gerente = Role::create(['name' => 'gerente']);
        $admin = Role::create(['name' => 'admin']);
        $secretaria = Role::create(['name' => 'secretaria']);
        $doctor = Role::create(['name' => 'doctor']);
        $paciente = Role::create(['name' => 'paciente']);

        Permission::create(['name' => 'welcome'])->syncRoles([$gerente, $admin, $secretaria, $doctor, $paciente]);
        Permission::create(['name' => 'home'])->syncRoles([$gerente, $admin, $secretaria, $doctor, $paciente]);


        Permission::create(['name' => 'modulo.rpu'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.users.create'])->syncRoles([$gerente, $admin, $secretaria]);
            Permission::create(['name' => 'admin.users.edit'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.users.store'])->syncRoles([$gerente, $admin, $secretaria]);
            Permission::create(['name' => 'admin.users.update'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.users.index'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.users.show'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.users.creedenciales'])->syncRoles([$gerente, $admin, $secretaria]);

        Permission::create(['name' => 'modulo.personas'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.personas.create'])->syncRoles([$gerente, $admin, $secretaria, $paciente]);
            Permission::create(['name' => 'admin.personas.edit'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.personas.store'])->syncRoles([$gerente, $admin, $secretaria, $paciente]);
            Permission::create(['name' => 'admin.personas.update'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.personas.destroy'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.personas.index'])->syncRoles([$gerente, $admin, $doctor, $paciente]);
            Permission::create(['name' => 'admin.personas.show'])->syncRoles([$gerente, $admin, $doctor, $paciente]);

        Permission::create(['name' => 'modulo.especialidades'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.especialidades.create'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.especialidades.edit'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.especialidades.store'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.especialidades.update'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.especialidades.destroy'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.especialidades.index'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.especialidades.show'])->syncRoles([$gerente, $admin]);

        Permission::create(['name' => 'modulo.citas'])->syncRoles([$gerente, $admin, $secretaria, $paciente]);
            Permission::create(['name' => 'admin.citas.create'])->syncRoles([$gerente, $admin, $secretaria, $paciente]);
            Permission::create(['name' => 'admin.citas.edit'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.citas.store'])->syncRoles([$gerente, $admin, $secretaria, $paciente]);
            Permission::create(['name' => 'admin.citas.update'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.citas.destroy'])->syncRoles([$gerente, $admin]);
            Permission::create(['name' => 'admin.citas.index'])->syncRoles([$gerente, $admin, $doctor, $secretaria, $paciente]);
            Permission::create(['name' => 'admin.citas.show'])->syncRoles([$gerente, $admin, $doctor, $paciente]);
            Permission::create(['name' => 'admin.citas.reprogramar'])->syncRoles([$gerente, $admin]);

        Permission::create(['name' => 'modulo.estadisticas'])->syncRoles([$gerente]);


    }
}
