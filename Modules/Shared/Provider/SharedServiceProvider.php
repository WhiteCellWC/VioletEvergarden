<?php

namespace Modules\Shared\Provider;

use Illuminate\Support\ServiceProvider;
use Modules\Shared\Contract\CoreImageServiceInterface;
use Modules\Shared\Contract\FileServiceInterface;
use Modules\Shared\Http\Service\CoreImageService;
use Modules\Shared\Http\Service\FileService;

class SharedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FileServiceInterface::class, FileService::class);
        $this->app->bind(CoreImageServiceInterface::class, CoreImageService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
