<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services
     */
    public function register(): void
    {
        $this->app->singleton(
            LoginResponse::class,
            \App\Http\Response\LoginResponse::class
        );

        FilamentAsset::register([
            Css::make('example-local-stylesheet', asset('/build/assets/app.css'))
            // Css::make('daisyui', 'https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css'),
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
