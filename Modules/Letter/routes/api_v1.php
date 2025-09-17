<?php

use Illuminate\Support\Facades\Route;
use Modules\Letter\Http\Controller\Api\V1\LetterApiController;
use Modules\Letter\Http\Controller\Api\V1\LetterTemplateApiController;
use Modules\Letter\Http\Controller\Api\V1\LetterTypeApiController;

Route::apiResource('letter-templates', LetterTemplateApiController::class);
Route::apiResource('letters', LetterApiController::class);
Route::apiResource('letter-types', LetterTypeApiController::class);
