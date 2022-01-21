<?php

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


// Authentication routes
Auth::routes();


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('aanmelding/approve/{id}', 'AanmeldingController@approve')->name('aanmelding.approve');
});

// Include Wave Routes
Wave::routes();

// Disable profile pages
Route::redirect('@{username}', '/');
