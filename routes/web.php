<?php

use App\Http\Controllers\CarsController;
use Illuminate\Support\Facades\Route;

Route::resource('/cars', CarsController::class);
