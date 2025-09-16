<?php

use Illuminate\Support\Facades\Route;
use Modules\Letter\Http\Controller\Api\V1\LetterTemplateApiController;

Route::apiResource('letter-templates', LetterTemplateApiController::class);
