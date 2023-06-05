<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SpecialityController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Secretaria\PacienteController;
use App\Http\Controllers\Paciente\AppointmentController as PatientAppointmentController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Doctor\DiagnosisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::controller(ChangePasswordController::class)->group(function () {
        Route::get('/cambiar-password', 'index')->name('view.change.password');
        Route::post('/cambiar-password', 'changePassword')->name('change.password');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile/create', 'create')->name('profile.create');
        Route::get('profile/{username}/edit', 'edit')->name('profile.edit');
        Route::put('profile/{id}', 'update')->name('profile.update');
        Route::post('profile', 'store')->name('profile.store');
    });


    Route::group([
        // 'middleware' => ['role:admin', 'role:superadmin', 'role:gerente'],
        'prefix' => 'admin', //stands for the /admin route. I mean It is the URL
        'as' => 'admin.', // Son route names para referirme a ellos como admin.users.index por ejemplo.

        ], function () {
            Route::resource('users', UserController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('specialities', SpecialityController::class);
            Route::resource('appointments', AppointmentController::class);

            Route::controller(ReportController::class)->group(function () {
                Route::get('/especialidad-cita', 'especialidadCita')->name('especialidad.cita');
                Route::get('/medico-cita', 'doctorCita')->name('doctor.cita');
                Route::get('/mes-cita', 'mesCita')->name('mes.cita');
                Route::get('/year-cita', 'anoCita')->name('ano.cita');
            });

            Route::resource('schedules', ScheduleController::class);
    });

    Route::group([
        'prefix' => 'secretaria', //stands for the /admin route. I mean It is the URL
        'as' => 'secretaria.', // Son route names para referirme a ellos como secretaria.users.index por ejemplo.
        'middleware' => 'role:secretaria'

        ], function () {
            Route::resource('pacientes', PacienteController::class);
            Route::post('imprimir-creedenciales', [PacienteController::class, 'imprimirCreedenciales'])->name('imprimir.creedenciales');
    });
    
    Route::group([
        'prefix' => 'doctor',
        'as' => 'doctor.',
        'middleware' => 'role:doctor'
        ], function () {
            // Route::resource('citas', DoctorAppointmentController::class);
            Route::get('citas', [DoctorAppointmentController::class, 'index'])->name('citas.index');

            Route::controller(DiagnosisController::class)->group(function () {
                Route::get('diagnosis/create/{appointment}', 'create')->name('diagnosis.create');
                Route::post('diagnosis-store', 'store')->name('diagnosis.store');
            });
    });


    Route::group([
        'prefix' => 'paciente',
        'as' => 'paciente.',
        'middleware' => 'role:paciente'
        ], function () {
            Route::resource('citas', PatientAppointmentController::class);
            Route::get('resumen-cita/{appointment}', [PatientAppointmentController::class, 'resumenCita'])->name('resumen');
            Route::get('/preview-pdf', [PatientAppointmentController::class, 'showPreviewPDF'])->name('previewCitas');
            Route::get('/cancelar-citas', [PatientAppointmentController::class, 'cancelarCitas'])->name('cancelarCitasPaciente');
    });

});
