<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|App\Http\Controllers\WelcomeControllers::class, 'index'
*/
Route::get('/', [App\Http\Controllers\MapController::class, 'index']);
Route::get('/security', [App\Http\Controllers\MapController::class, 'security']);
Route::get('/upcomingprojects', [App\Http\Controllers\MapController::class, 'upcomingprojects']);
Route::get('/hospitals', [App\Http\Controllers\MapController::class, 'hospitals']);
Route::get('/fetch-amenities', [App\Http\Controllers\MapController::class, 'fetchAmenities']);

