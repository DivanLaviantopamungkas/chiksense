<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\SensorDataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
Route::post('/monitoring/store-reading', [MonitoringController::class, 'StoreReading'])->name('monitoring.storeReading');
