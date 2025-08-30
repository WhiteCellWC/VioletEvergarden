<?php

namespace Modules\Location\Provider;

use Illuminate\Support\ServiceProvider;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\Http\Service\CountryService;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CountryServiceInterface::class, CountryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
