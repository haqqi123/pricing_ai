<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['status' => 'ok']);
});

Route::get('/pricing', [\App\Http\Controllers\PricingController::class, 'getPrice']);