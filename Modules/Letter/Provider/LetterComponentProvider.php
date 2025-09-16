<?php

namespace Modules\Letter\Provider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Letter\Contract\LetterTemplateServiceInterface;
use Modules\Letter\Http\Service\LetterTemplateService;

class LetterComponentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LetterTemplateServiceInterface::class, LetterTemplateService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('api')
            ->prefix('api/v1')
            ->group(function () {
                require __DIR__ . '/../routes/api_v1.php';
            });
    }
}
