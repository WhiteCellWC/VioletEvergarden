<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Location\Http\Controller\Backend\CountryController;
use Modules\Location\Http\Controller\Backend\StateController;

Route::get('/', function () {
    return Inertia::render('Dashboard/Dashboard');
})->name('dashboard');

Route::resource('states', StateController::class);
Route::resource('countries', CountryController::class);
