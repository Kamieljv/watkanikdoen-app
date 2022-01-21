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
Route::get('logout', 'Auth\LoginController@logout')->name('wave.logout');
Route::get('user/verify/{verification_code}', 'Auth\RegisterController@verify')->name('verify');
Route::post('register/complete', '\Wave\Http\Controllers\Auth\RegisterController@complete')->name('wave.register-complete');


// Include voyager routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('aanmelding/approve/{id}', 'AanmeldingController@approve')->name('aanmelding.approve');
});

// Wave impersonation route
Route::impersonate();

// Home route
Route::get('/', '\Wave\Http\Controllers\HomeController@index')->name('wave.home');

// Translation file route
Route::get('/lang-{lang}.js', '\Wave\Http\Controllers\LanguageController@show');

// Acties & Organizers
Route::get('acties/search', '\Wave\Http\Controllers\ActieController@search')->name('wave.acties.search');
Route::get('actie/{actie}', '\Wave\Http\Controllers\ActieController@actie')->name('wave.acties.actie');
Route::get('organizer/{organizer}', '\Wave\Http\Controllers\OrganizerController@organizer')->name('wave.organizers.organizer');

// Blog routes
Route::get('blog', '\Wave\Http\Controllers\BlogController@index')->name('wave.blog');
Route::get('blog/{category}', '\Wave\Http\Controllers\BlogController@category')->name('wave.blog.category');
Route::get('blog/{category}/{post}', '\Wave\Http\Controllers\BlogController@post')->name('wave.blog.post');

// General page route
Route::get('{page}', '\Wave\Http\Controllers\PageController@page')->name('wave.page');

// Routes that require authemtication
Route::group(['prefix' => 'auth', 'middleware' => 'auth'], function () {
    // Dashboard
    Route::get('dashboard', '\Wave\Http\Controllers\DashboardController@index')->name('wave.dashboard');

    // Settings
    Route::get('settings/{section?}', '\Wave\Http\Controllers\SettingsController@index')->name('wave.settings');
    Route::post('settings/profile', '\Wave\Http\Controllers\SettingsController@profilePut')->name('wave.settings.profile.put');
    Route::put('settings/security', '\Wave\Http\Controllers\SettingsController@securityPut')->name('wave.settings.security.put');

    // Notifications & Announcements
    Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
    Route::get('announcements', '\Wave\Http\Controllers\AnnouncementController@index')->name('wave.announcements');
    Route::get('announcement/{id}', '\Wave\Http\Controllers\AnnouncementController@announcement')->name('wave.announcement');
    Route::post('announcements/read', '\Wave\Http\Controllers\AnnouncementController@read')->name('wave.announcements.read');
    Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
    Route::post('notification/read/{id}', '\Wave\Http\Controllers\NotificationController@delete')->name('wave.notification.read');
});
