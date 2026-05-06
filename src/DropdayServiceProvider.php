<?php

namespace Dropday\Dropday;

use Illuminate\Support\ServiceProvider;

class DropdayServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/dropday.php', 'dropday');

        $this->app->singleton(Dropday::class, function () {
            return new Dropday(
                apiKey: config('dropday.api_key'),
                accountId: config('dropday.account_id'),
                baseUrl: config('dropday.base_url'),
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/dropday.php' => config_path('dropday.php'),
        ], 'dropday-config');
    }
}
