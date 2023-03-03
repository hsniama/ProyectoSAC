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

        Role::create(['name' => 'super-admin']); // get all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'gerente']);
        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'secretaria']);
        Role::create(['name' => 'paciente']);
    }
}
