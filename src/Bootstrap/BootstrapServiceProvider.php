<?php

namespace MarvinLabs\Html\Bootstrap;

use Illuminate\Support\ServiceProvider;
use MarvinLabs\Html\Bootstrap\Contracts\FormErrorProvider as FormErrorProviderContract;
use MarvinLabs\Html\Bootstrap\Contracts\FormState as FormStateContract;
use MarvinLabs\Html\Bootstrap\Contracts\OldFormInputProvider as OldFormInputProviderContract;
use MarvinLabs\Html\Bootstrap\Forms\FormErrorProvider;
use MarvinLabs\Html\Bootstrap\Forms\FormState;
use MarvinLabs\Html\Bootstrap\Forms\OldFormInputProvider;

/**
 * Class BootstrapServiceProvider
 * @package MarvinLabs\Html\Bootstrap
 *
 *          The package's main service provider
 */
class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'bs');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'bs');

        if ($this->app->runningInConsole())
        {
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/bs'),
            ], 'views');

            $this->publishes([
                __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/bs'),
            ], 'lang');

            $this->publishes([
                __DIR__ . '/../../config' => resource_path('config'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Bootstrap::class);
        $this->app->singleton(FormErrorProviderContract::class, FormErrorProvider::class);
        $this->app->singleton(OldFormInputProviderContract::class, OldFormInputProvider::class);
        $this->app->bind(FormStateContract::class, FormState::class);
    }

}