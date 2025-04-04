<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\AirportController;
use App\Http\Controllers\Api\AirplaneController;
use App\Http\Controllers\Api\ReservationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/airplane', [AirplaneController::class, 'index'])->name('apiIndexAirplane');
Route::post('/airplane', [AirplaneController::class, 'store'])->name('apiStoreAirplane');
Route::get('/airplane/{id}', [AirplaneController::class, 'show'])->name('apiShowAirplane');
Route::put('/airplane/{id}', [AirplaneController::class, 'update'])->name('apiUpdateAirplane');
Route::delete('/airplane/{id}', [AirplaneController::class, 'destroy'])->name('apiDestroyAirplane');

Route::get('flights', [FlightController::class, 'index'])->name('apiIndexFlight');
Route::get('flights/{id}', [FlightController::class, 'show'])->name('apiIndexFlight');
Route::post('flights', [FlightController::class, 'store'])->name('apiIndexFlight');
Route::put('flights/{id}', [FlightController::class, 'update'])->name('apiIndexFlight');
Route::delete('flights/{id}', [FlightController::class, 'destroy'])->name('apiIndexFlight');

Route::get('airports', [AirportController::class, 'index'])->name('apiIndexAirplane');
Route::post('airports', [AirportController::class, 'store'])->name('apiStoreAirplane');
Route::get('airports/{id}', [AirportController::class, 'show'])->name('apiShowAirplane');
Route::put('airports/{id}', [AirportController::class, 'update'])->name('apiUpdateAirplane');
Route::delete('airports/{id}', [AirportController::class, 'destroy'])->name('apiDestroyAirplane');

Route::get('users', [UserController::class, 'index'])->name('apiIndexUser');
Route::post('users', [UserController::class, 'store'])->name('apiStoreUser');
Route::get('users/{id}', [UserController::class, 'show'])->name('apiShowUser');
Route::put('users/{id}', [UserController::class, 'update'])->name('apiUpdateUser');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('apiDestroyUser');

Route::get('reservations', [ReservationController::class, 'index'])->name('apiIndexReservation');
Route::post('reservations', [ReservationController::class, 'store'])->name('apiStoreReservation');
Route::get('reservations/{id}', [ReservationController::class, 'show'])->name('apiShowReservation');
Route::put('reservations/{id}', [ReservationController::class, 'update'])->name('apiUpdateReservation');
Route::delete('reservations/{id}', [ReservationController::class, 'destroy'])->name('apiDestroyReservation');