<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PricingController;

Route::post('/price-recommendation', [PricingController::class, 'getPrice']);
