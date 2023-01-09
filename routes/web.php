<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\RoleController;

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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');;

    Route::group([
        //'middleware' => 'is_admin'
        'prefix' => 'admin', //stands for the /admin route. I mean It is the URL
        'as' => 'admin.', // Son route names para referirme a ellos como admin.users.index por ejemplo.

        ],function (){
            Route::resource('users', UserController::class);
            Route::resource('personas', PersonaController::class);
            Route::resource('roles', RoleController::class);
    });
});