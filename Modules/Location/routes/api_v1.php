<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\Http\Controller\Api\V1\CountryApiController;
use Modules\Location\Http\Controller\Api\V1\StateApiController;

Route::apiResource('countries', CountryApiController::class);

Route::apiResource('states', StateApiController::class);
