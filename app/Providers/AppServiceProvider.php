<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use App\Models\Horario;
use App\Observers\HorarioObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        ResetPassword::createUrlUsing(static function ($notifiable, $token) {
            // Url of the fronted app for resetting password...
            return config('app.url').'/reset-password/'.$token;
        });
        Horario::observe(HorarioObserver::class);
    }
}
