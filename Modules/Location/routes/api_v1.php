<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\Http\Controller\Api\V1\CountryApiController;

Route::prefix('v1')->group(function () {
    Route::apiResource('countries', CountryApiController::class);
});
