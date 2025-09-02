<?php

use Illuminate\Support\Facades\Route;
use Modules\LetterComponent\Http\Controller\Api\V1\FragranceTypeApiController;

Route::apiResource('fragrance-types', FragranceTypeApiController::class);
