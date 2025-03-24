<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\AirportController;
use App\Http\Controllers\Api\AirplaneController;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/airplane', [AirplaneController::class, 'index'])->name('apiIndexAirplane');
Route::post('/airplane', [AirplaneController::class, 'store'])->name('apiStoreAirplane');
Route::get('/airplane/{id}', [AirplaneController::class, 'show'])->name('apiShowAirplane');
Route::put('/airplane/{id}', [AirplaneController::class, 'update'])->name('apiUpdateAirplane');
Route::delete('/airplane/{id}', [AirplaneController::class, 'destroy'])->name('apiDestroyAirplane');

Route::get('flights', [FlightController::class, 'index'])->name('apiIndexFlight');
Route::get('flights/{id}', [FlightController::class, 'show'])->name('apiShowFlight');
Route::post('flights', [FlightController::class, 'store'])->name('apiStoreFlight');
Route::put('flights/{id}', [FlightController::class, 'update'])->name('apiUpdateFlight');
Route::delete('flights/{id}', [FlightController::class, 'destroy'])->name('apiDestroyFlight');

Route::get('airports', [AirportController::class, 'index'])->name('apiIndexAirport');
Route::post('airports', [AirportController::class, 'store'])->name('apiStoreAirport');
Route::get('airports/{id}', [AirportController::class, 'show'])->name('apiShowAirport');
Route::put('airports/{id}', [AirportController::class, 'update'])->name('apiUpdateAirport');
Route::delete('airports/{id}', [AirportController::class, 'destroy'])->name('apiDestroyAirport');

Route::get('users', [UserController::class, 'index'])->name('apiIndexUser');
Route::post('users', [UserController::class, 'store'])->name('apiStoreUser');
Route::get('users/{id}', [UserController::class, 'show'])->name('apiShowUser');
Route::put('users/{id}', [UserController::class, 'update'])->name('apiUpdateUser');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('apiDestroyUser');