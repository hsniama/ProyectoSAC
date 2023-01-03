<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // PERMISOS
        $permissions = [
            'welcome',
            'home',
            'modulo-rpu',
            'modulo-personas',
            'modulo-especialidades',
            'modulo-citas',
            'modulo-estadisticas',
            'user-list',
            'user-show',
            'user-create',
            'user-edit',
            'user-delete',
            'user-creedenciales',
            'role-list',
            'role-show',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-show',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'persona-list',
            'persona-show',
            'persona-create',
            'persona-edit',
            'persona-delete',
            'medico-list',
            'medico-show',
            'medico-create',
            'medico-edit',
            'medico-delete',
            'especialidad-list',
            'especialidad-show',
            'especialidad-create',
            'especialidad-edit',
            'especialidad-delete',
            'cita-list',
            'cita-show',
            'cita-create',
            'cita-edit',
            'cita-delete',
            'cita-reprogramar',
            'consulta-list',
            'consulta-show',
            'consulta-create',
            'consulta-edit',
            'consulta-delete',
            'receta-list',
            'receta-show',
            'receta-create',
            'receta-edit',
            'receta-delete',
            'diagnostico-list',
            'diagnostico-show',
            'diagnostico-create',
            'diagnostico-edit',
            'diagnostico-delete',
            'detalle-receta-list',
            'detalle-receta-show',
            'detalle-receta-create',
            'detalle-receta-edit',
            'detalle-receta-delete',
            'detalle-diagnostico-list',
            'detalle-diagnostico-show',
            'detalle-diagnostico-create',
            'detalle-diagnostico-edit',
            'detalle-diagnostico-delete',
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }


        // ASIGNACION DE PERMISOS A GERENTE
        $gerente = Role::where('name', 'gerente')->first();
        // Tiene acceso a todos los módulos y funcionalidades del sistema.
        //Tiene acceso al módulo de Estadísticas en Salud.   

        $gerentePermissions = [
            'welcome',
            'home',
            'modulo-estadisticas',
            'modulo-rpu',
                'user-list',
                'user-show',
                'user-create',
                'user-edit',
                'user-delete',
                'user-creedenciales',
                'role-list',
                'role-show',
                'role-create',
                'role-edit',
                'role-delete',
                'permission-list',
                'permission-show',
                'permission-create',
                'permission-edit',
                'permission-delete',
            'modulo-citas',
                'cita-list',
                'cita-show',
                'cita-create',
                'cita-edit',
                'cita-delete',
                'cita-reprogramar',
            'modulo-personas',
                'persona-list',
                'persona-show',
                'persona-create',
                'persona-edit',
                'persona-delete',
            'modulo-especialidades',
                'especialidad-list',
                'especialidad-show',
                'especialidad-create',
                'especialidad-edit',
                'especialidad-delete',
        ];

        foreach ($gerentePermissions as $permission) {
            $gerente->givePermissionTo($permission);
        }

        //ASIGNACION DE PERMISOS A ADMINISTRADOR
        $administrador = Role::where('name', 'admin')->first();
        //Tiene acceso a todos los módulos y funcionalidades del sistema. 

        $adminPermissions = [
            'welcome',
            'home',
            'modulo-rpu',
                'user-list',
                'user-show',
                'user-create',
                'user-edit',
                'user-delete',
                'user-creedenciales',
                'role-list',
                'role-show',
                'role-create',
                'role-edit',
                'role-delete',
                'permission-list',
                'permission-show',
                'permission-create',
                'permission-edit',
                'permission-delete',
            'modulo-citas',
                'cita-list',
                'cita-show',
                'cita-create',
                'cita-edit',
                'cita-delete',
                'cita-reprogramar',
            'modulo-personas',
                'persona-list',
                'persona-show',
                'persona-create',
                'persona-edit',
                'persona-delete',
            'modulo-especialidades',
                'especialidad-list',
                'especialidad-show',
                'especialidad-create',
                'especialidad-edit',
                'especialidad-delete',  
        ];

        foreach ($adminPermissions as $permission) {
            $administrador->givePermissionTo($permission);
        }

        // ASIGNACION DE PERMISOS A DOCTOR
        $doctor = Role::where('name', 'doctor')->first();
        // Tiene acceso solo al módulo Visualización de citas por parte del Médico. 

        $doctorPermissions = [
            'welcome',
            'home',
            'modulo-citas',
            'cita-list',
        ];

        foreach ($doctorPermissions as $permission) {
            $doctor->givePermissionTo($permission);
        }

        // ASIGNACION DE PERMISOS A SECRETARIA
        $secretaria = Role::where('name', 'secretaria')->first();
        // Tiene acceso solo al módulo de Gestión de Citas. 
        // Puede registrar a un paciente (antes debe registrar un usuario) y asignarle una cita.
        // Puede imprimir creedenciales de acceso al sistema para el paciente (User y Password).

        $secretariaPermissions = [
           'welcome',
            'home',
            'modulo-citas',
            'cita-list',
            'cita-show',
            'cita-create',
            'user-create',
            'persona-create',
            'user-creedenciales',
        ];

        foreach ($secretariaPermissions as $permission) {
            $secretaria->givePermissionTo($permission);
        }

        //ASIGNACION DE PERMISOS A PACIENTE
        $paciente = Role::where('name', 'paciente')->first();

        $pacientePermissions = [
            'welcome',
            'home',
            'modulo-citas',
            'cita-list',
            'cita-show',
            'cita-create',
        ];

        foreach ($pacientePermissions as $permission) {
            $paciente->givePermissionTo($permission);
        }

    }
}
