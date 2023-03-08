<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\SpecialityController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Secretaria\PacienteController;

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
        Route::get('profile/{id}/edit', 'edit')->name('profile.edit');
        Route::put('profile/{id}', 'update')->name('profile.update');
        Route::post('profile', 'store')->name('profile.store');
    });

    // JSON: Get the doctors of a speciality
    Route::get('/especialidades/{speciality}/doctores', [App\Http\Controllers\API\SpecialityController::class, 'doctors'])->name('especialidades.doctores');
    // JSON: Get all specialities
    Route::get('/especialidades', [App\Http\Controllers\API\SpecialityController::class, 'specialities'])->name('especialidades.crear.doctor');

    Route::group([
        //'middleware' => 'is_admin'
        'prefix' => 'admin', //stands for the /admin route. I mean It is the URL
        'as' => 'admin.', // Son route names para referirme a ellos como admin.users.index por ejemplo.

        ], function () {
            Route::resource('users', UserController::class);
            // Route::resource('persons', PersonController::class);
            // Route::get('persons/{user}/create', [PersonController::class, 'createSegunRol'])->name('persons.create.personrol');
            Route::resource('roles', RoleController::class);
            Route::resource('specialities', SpecialityController::class);
            Route::resource('appointments', AppointmentController::class);

            Route::controller(ReportController::class)->group(function () {
                Route::get('/especialidad-cita', 'especialidadCita')->name('especialidad.cita');
                Route::get('/medico-cita', 'doctorCita')->name('doctor.cita');
                Route::get('/mes-cita', 'mesCita')->name('mes.cita');
                Route::get('/year-cita', 'anoCita')->name('ano.cita');
            });
        });

    Route::group([
        'prefix' => 'secretaria', //stands for the /admin route. I mean It is the URL
        'as' => 'secretaria.', // Son route names para referirme a ellos como secretaria.users.index por ejemplo.
        'middleware' => 'role:secretaria'

        ], function () {
            Route::resource('pacientes', PacienteController::class);
            Route::post('imprimir-creedenciales', [PacienteController::class, 'imprimirCreedenciales'])->name('imprimir.creedenciales');
        });
});
