<?php namespace Railroad\Maropost\Providers;

use Illuminate\Support\ServiceProvider;
use Railroad\Maropost\Commands\CreateTags;

class MaropostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/../../config/maropost.php' => config_path('maropost.php'),
            ]
        );

        $this->commands(
            [
                CreateTags::class,
            ]
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}