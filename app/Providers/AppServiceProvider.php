<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

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
    public function boot(URLGenerator $url)
    {
        Schema::defaultStringLength(191);
        if (config('app.env') !== 'local' && config('app.https')) {
            $url->forceScheme('https');
        }
    }
}
