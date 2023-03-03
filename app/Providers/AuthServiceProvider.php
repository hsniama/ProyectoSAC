<?php

namespace App\Providers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth; // Agrego esta
use Illuminate\Support\Facades\Gate; // Agrego esta
use Illuminate\Auth\Notifications\VerifyEmail; // Agrego esta
use Illuminate\Notifications\Messages\MailMessage; // Agrego esta
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "super-admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });


        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new Mailmessage)
            ->subject('Envio de creedenciales del sistema y verificación de cuenta')
            ->line('Bienvenido a nuestro sistema de atención médica.')
            ->line('Una vez dentro del sistema, debes cambiar tu contraseña por una de tu preferencia.')
            ->line('Credenciales de sistema:')
            ->line('Usuario: '.$notifiable->username)
            ->line('Contraseña: password')
            ->line('Clic aqui para verificar tu cuenta:')
            ->action('Verificar cuenta', $url);
        });
    }
}
