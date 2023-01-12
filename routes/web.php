<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\Auth\ChangePasswordController;
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

    Route::controller(PerfilController::class)->group(function () {
        Route::get('perfil/create', 'create')->name('perfil.create');
        Route::get('perfil/{id}/edit', 'edit')->name('perfil.edit');
        Route::put('perfil/{id}', 'update')->name('perfil.update');
        Route::post('perfil', 'store')->name('perfil.store');
    });


    Route::group([
        //'middleware' => 'is_admin'
        'prefix' => 'admin', //stands for the /admin route. I mean It is the URL
        'as' => 'admin.', // Son route names para referirme a ellos como admin.users.index por ejemplo.

        ],function (){
            Route::resource('users', UserController::class);
            Route::resource('personas', PersonaController::class);
            Route::resource('roles', RoleController::class);
    });

    Route::group([
        'prefix' => 'secretaria', //stands for the /admin route. I mean It is the URL
        'middleware' => 'role:secretaria'
        //'as' => 'secretaria.', // Son route names para referirme a ellos como admin.users.index por ejemplo.

        ],function (){
            Route::resource('users', UserController::class);

    });

});