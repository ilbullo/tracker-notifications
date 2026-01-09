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
        Blade::component('tracker-notifications::components.confirm-modal', 'tracker-confirm');
        
        // Pubblicazione delle viste (solo in console)
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $viewPath => $this->app->make('path.resources') . '/views/vendor/tracker-notifications',
            ], 'tracker-notifications-views');
        }

        //config files
        $this->publishes([
            __DIR__.'/../config/tracker-notifications.php' => $this->app->configPath('tracker-notifications.php'),
        ], 'tracker-notifications-config');
    }

    /**
     * Registrazione dei servizi (opzionale).
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tracker-notifications.php', 
            'tracker-notifications'
        );
    }
}