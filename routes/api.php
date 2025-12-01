<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ActieController;
use App\Http\Controllers\Api\ThemeController;
use App\Http\Controllers\Api\OrganizerController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// API v1 Routes
Route::prefix('v1')->name('api.v1.')->group(function () {
    // Public resource routes
    Route::get('acties', [ActieController::class, 'index'])->name('acties.index');
    Route::get('acties/{slug}', [ActieController::class, 'show'])->name('acties.show');
    
    Route::get('themes', [ThemeController::class, 'index'])->name('themes.index');
    Route::get('themes/{slug}', [ThemeController::class, 'show'])->name('themes.show');
    
    Route::get('organizers', [OrganizerController::class, 'index'])->name('organizers.index');
    Route::get('organizers/{slug}', [OrganizerController::class, 'show'])->name('organizers.show');
    
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
});
