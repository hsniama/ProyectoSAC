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
            'modulo-persons',
            'modulo-especialidades',
            'modulo-appointments',
            'modulo-estadisticas',
            'modulo-reportes',
            'modulo-horarios',
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
            'person-list',
            'person-show',
            'person-create',
            'person-edit',
            'person-delete',
            'profile-create',
            'profile-edit',
            'profile-update',
            'profile-store',
            'paciente-list',
            'paciente-show',
            'paciente-create',
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
            'appointment-list',
            'appointment-show',
            'appointment-create',
            'appointment-edit',
            'appointment-delete',
            'appointment-reprogramar',
            'diagnostico-list',
            'diagnostico-show',
            'diagnostico-create',
            'diagnostico-edit',
            'diagnostico-delete',
            'export-buttons',
            'horarios-list',
            'horarios-show',
            'horarios-create',
            'horarios-edit',
            'horarios-delete',
        ];

        foreach ($permissions as $permission) {
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
            'modulo-reportes',
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
            'modulo-appointments',
                'appointment-list',
                'appointment-show',
                'appointment-create',
                'appointment-edit',
                'appointment-delete',
                'appointment-reprogramar',
            'modulo-persons',
                'person-list',
                'person-show',
                'person-create',
                'person-edit',
                'person-delete',
                'profile-create',
                'profile-edit',
                'profile-update',
                'profile-store',
            'modulo-especialidades',
                'especialidad-list',
                'especialidad-show',
                'especialidad-create',
                'especialidad-edit',
                'especialidad-delete',
            'export-buttons'
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
            'modulo-appointments',
                'appointment-list',
                'appointment-show',
                'appointment-create',
                'appointment-edit',
                'appointment-delete',
                'appointment-reprogramar',
            'modulo-persons',
                'person-list',
                'person-show',
                'person-create',
                'person-edit',
                'person-delete',
                'profile-create',
                'profile-edit',
                'profile-update',
                'profile-store',
            'modulo-especialidades',
                'especialidad-list',
                'especialidad-show',
                'especialidad-create',
                'especialidad-edit',
                'especialidad-delete',
            'export-buttons'
        ];

        foreach ($adminPermissions as $permission) {
            $administrador->givePermissionTo($permission);
        }

        // ASIGNACION DE PERMISOS A DOCTOR
        $doctor = Role::where('name', 'doctor')->first();
        // Tiene acceso solo al módulo Visualización de appointments por parte del Médico.
        // (Puede ver las appointments asignadas a él, pero no puede modificarlas, ni eliminarlas, ni reprogramarlas.)

        $doctorPermissions = [
            'welcome',
            'home',
            // 'modulo-appointments',
            'appointment-list', // si uso esta permiso, el doctor puede ver todas las citas
            'profile-create',
            'profile-edit',
            'profile-update',
            'profile-store',
            'diagnostico-list',
            'diagnostico-show',
            'diagnostico-create',
            'diagnostico-edit',
            'diagnostico-delete',
        ];

        foreach ($doctorPermissions as $permission) {
            $doctor->givePermissionTo($permission);
        }

        // ASIGNACION DE PERMISOS A SECRETARIA
        $secretaria = Role::where('name', 'secretaria')->first();
        // Tiene acceso solo al módulo de Gestión de appointments.
        // Puede registrar a un paciente (antes debe registrar un usuario) y asignarle una appointment.
        // Puede imprimir creedenciales de acceso al sistema para el paciente (User y Password).

        $secretariaPermissions = [
           'welcome',
            'home',
            // 'modulo-appointments',
            // 'appointment-list',
            // 'appointment-show',
            'appointment-create',
            'user-create',
            'user-creedenciales',
            'person-create',
            'paciente-create',
            'paciente-list',
            'paciente-show',
            'profile-create',
            'profile-edit',
            'profile-update',
            'profile-store',
        ];

        foreach ($secretariaPermissions as $permission) {
            $secretaria->givePermissionTo($permission);
        }

        //ASIGNACION DE PERMISOS A PACIENTE
        $paciente = Role::where('name', 'paciente')->first();

        $pacientePermissions = [
            'welcome',
            'home',
            // 'modulo-appointments',
            'appointment-create',
            'appointment-list',
            'appointment-delete',
            'profile-create',
            'profile-edit',
            'profile-update',
            'profile-store',
        ];

        foreach ($pacientePermissions as $permission) {
            $paciente->givePermissionTo($permission);
        }
    }
}
