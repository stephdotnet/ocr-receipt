<?php

namespace App\Providers;

use App\Services\OCR\OCRManager;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(OCRManager::class, function ($app) {
            return new OCRManager($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('codespace')) {
            URL::forceRootUrl(Config::get('app.url'));
            if (Str::contains(Config::get('app.url'), 'https://')) {
                URL::forceScheme('https');
            }
        }
    }
}
