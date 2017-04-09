<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Prettus\Repository\Providers\RepositoryServiceProvider::class);
            $this->app->register(\InfyOm\Generator\InfyOmGeneratorServiceProvider::class);
            $this->app->register(\InfyOm\AdminLTETemplates\AdminLTETemplatesServiceProvider::class);
        }
    }
}
