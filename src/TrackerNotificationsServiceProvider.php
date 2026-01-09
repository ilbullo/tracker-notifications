<?php 

namespace Ilbullo\TrackerNotifications;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class TrackerNotificationsServiceProvider extends ServiceProvider
{
    /**
     * Boot del package.
     */
    public function boot(): void
    {
        // Usiamo __DIR__ per calcolare i percorsi relativi alla posizione del file
        $viewPath = __DIR__ . '/../resources/views';

        // Carica le viste usando il namespace del package
        $this->loadViewsFrom($viewPath, 'tracker-notifications');

        // Registra il componente Blade con alias 'tracker-toaster'
        Blade::component('tracker-notifications::components.toaster', 'tracker-toaster');

        // Pubblicazione delle viste (solo in console)
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $viewPath => $this->app->make('path.resources') . '/views/vendor/tracker-notifications',
            ], 'tracker-notifications-views');
        }
    }

    /**
     * Registrazione dei servizi (opzionale).
     */
    public function register(): void
    {
        // Qui potresti registrare file di configurazione o singleton
    }
}