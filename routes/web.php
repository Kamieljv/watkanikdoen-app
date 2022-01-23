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

use App\Http\Controllers\AanmeldingController;
use App\Http\Controllers\ActieController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingsController;

// Authentication routes
Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('user/verify/{verification_code}', [RegisterController::class, 'verify'])->name('verify');

// Include voyager routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('aanmelding/approve/{id}', [AanmeldingController::class, 'approve'])->name('aanmelding.approve');
});

// Wave impersonation route
Route::impersonate();

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Translation file route
Route::get('/lang-{lang}.js', [LanguageController::class, 'show']);

// Acties & Organizers
Route::get('acties/search', [ActieController::class, 'search'])->name('acties.search');
Route::get('actie/{actie}', [ActieController::class, 'actie'])->name('acties.actie');
Route::get('organizer/{organizer}', [OrganizerController::class, 'organizer'])->name('organizers.organizer');

// Acties aanmelden (guest)
Route::get('acties/aanmelden', [AanmeldingController::class, 'landing'])->name('aanmelding.landing');

// Blog routes
Route::get('blog/index', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{category}', [BlogController::class, 'category'])->name('blog.category');
Route::get('blog/{category}/{post}', [BlogController::class, 'post'])->name('blog.post');

// General page route
Route::get('{page}', [PageController::class, 'page'])->name('page');

// Routes that require authemtication
Route::group(['prefix' => 'auth', 'middleware' => 'auth'], function () {
    // Dashboard
    Route::get('aanmeldingen', [AanmeldingController::class, 'index'])->name('aanmeldingen');

    // Acties aanmelden (authenticated)
    Route::get('aanmelden/form', [AanmeldingController::class, 'form'])->name('aanmelding.form');

    // Settings
    Route::get('settings/{section?}', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings/profile', [SettingsController::class, 'profilePut'])->name('settings.profile.put');
    Route::put('settings/security', [SettingsController::class, 'securityPut'])->name('settings.security.put');

    // Notifications & Announcements
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements');
    Route::get('announcement/{id}', [AnnouncementController::class, 'announcement'])->name('announcement');
    Route::post('announcements/read', [AnnouncementController::class, 'read'])->name('announcements.read');
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('notification/read/{id}', [NotificationController::class, 'delete'])->name('notification.read');
});
