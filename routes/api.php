<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ScheduleController as ScheduleAPIController;
use App\Http\Controllers\API\SpecialityController as SpecialityAPIController;
use App\Http\Controllers\API\AppointmentController as AppointmentAPIController;
use App\Http\Controllers\API\ChartsController as ChartsAPIController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    // JSON: Get the doctors of a speciality. OJO PROTEGER ESTA RUTA DE API EN UN FUTURO.
    Route::get('/especialidades/{speciality}/doctores', [SpecialityAPIController::class, 'getActiveDoctors'])->name('especialidades.doctores');

    // JSON: Get all specialities. Protect with middleware only role admin
    Route::get('/especialidades', [SpecialityAPIController::class, 'specialities'])->name('especialidades.crear.doctor');

    //Route for my API/ScheduleController
    Route::get('/schedule/hours', [ScheduleAPIController::class, 'getAvailableHours'])->name('schedule.hours');

    // JSON: Get the data of the patient from the form to create a new appointment
    Route::get('/get-patient-data/{cedula}', [AppointmentAPIController::class, 'getPatientData'])->name('get.patient.data');

    // JSON: Get the patient's appointment data from the form
    Route::post('/get-appointment-data', [AppointmentAPIController::class, 'getAppointmentData'])->name('get.appointment.data');
    // uso post porque voy a enviar datos del formulario (cliente) al servidor.

    Route::post('/eliminar-cita-paciente', [AppointmentAPIController::class, 'cancelAppFromAdmin'])->name('eliminar.cita.paciente.desde.admin');

    Route::get('/covid-chart/data-year', [ChartsAPIController::class, 'covidChartByYear'])->name('covid.chart.data.year'); //Ej: ?year=2021

