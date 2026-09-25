<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarAdController;
use App\Http\Controllers\BikeAdController;
use App\Http\Controllers\SearchController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Car Ads
Route::resource('car-ads', CarAdController::class)->middleware('auth');
Route::get('/car-ads/{id}', [CarAdController::class, 'show'])->name('car-ads.show');

// Bike Ads
Route::resource('bike-ads', BikeAdController::class)->middleware('auth');
Route::get('/bike-ads/{id}', [BikeAdController::class, 'show'])->name('bike-ads.show');

// Auth Routes
require __DIR__.'/auth.php';