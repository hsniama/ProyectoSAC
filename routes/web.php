<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\Admin\UserController;

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

Auth::routes();


// Route::resource('personas', PersonaController::class)->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group([
        //'middleware' => 'is_admin'
        'prefix' => 'admin', //stands for the /admin route. I mean It is the URL
        'as' => 'admin.', // Son route names para referirme a ellos como admin.users.index por ejemplo.

        ],function (){
            Route::resource('users', UserController::class);
    });

    Route::group([
        //'middleware' => 'is_admin'
        'prefix' => 'user',
        'as' => 'user.',

        ],function (){
            
    });


});