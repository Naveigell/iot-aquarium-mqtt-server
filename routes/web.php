<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\DashboardController::class)->name('dashboard.index');
Route::get('/logs/details', [\App\Http\Controllers\LogController::class, 'detail'])->name('logs.details.index');
Route::get('/logs/drains', [\App\Http\Controllers\LogController::class, 'drain'])->name('logs.drains.index');
Route::get('/api/details', \App\Http\Controllers\Api\DetailController::class)->name('api.details.index');

Route::post('/mosquittos/store', [\App\Http\Controllers\MqttMosquittoController::class, 'store'])->name('mosquittos.store');
