<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AirplaneController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/airplane', [AirplaneController::class, 'index'])->name('apiIndexAirplane');
Route::post('/airplane', [AirplaneController::class, 'store'])->name('apiStoreAirplane');
Route::get('/airplane/{id}', [AirplaneController::class, 'show'])->name('apiShowAirplane');
Route::put('/airplane/{id}', [AirplaneController::class, 'update'])->name('apiUpdateAirplane');
Route::delete('/airplane/{id}', [AirplaneController::class, 'destroy'])->name('apiDestroyAirplane');