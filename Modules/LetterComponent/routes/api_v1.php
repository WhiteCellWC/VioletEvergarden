<?php

use Illuminate\Support\Facades\Route;
use Modules\LetterComponent\Http\Controller\Api\V1\EnvelopeTypeApiController;
use Modules\LetterComponent\Http\Controller\Api\V1\FragranceTypeApiController;

Route::apiResource('fragrance-types', FragranceTypeApiController::class);
Route::apiResource('envelope-types', EnvelopeTypeApiController::class);
