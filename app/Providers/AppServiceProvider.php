<?php

namespace App\Providers;

use App\Models\Diagnosis;
use App\Models\Appointment;
use Illuminate\Support\Facades\URL;
use App\Observers\DiagnosisObserver;
use App\Observers\AppointmentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Las siguientes lineas de codigo se comentan para evitar que se envien correos electronicos 
        //al momento de ejecutar las pruebas. Es decir, cuando hacemos un php artisan migrate:fresh --seed
        Appointment::observe(AppointmentObserver::class);
        Diagnosis::observe(DiagnosisObserver::class);

        if($this->app->environment('production')){
            URL::forceScheme('https');
        }
    }
}
