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

use App\Http\Controllers\ActieController;
// use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;

// Authentication routes
Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('user/verify/{verification_code}', [RegisterController::class, 'verify'])->name('verify');
Route::get('register/complete', [RegisterController::class, 'complete'])->name('registration.complete');

// Include voyager routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('report/approve/{id}', [ReportController::class, 'approve'])->name('report.approve');
    Route::post('images/delete_unlinked', [ImageController::class, 'deleteUnlinked'])->name('images.delete_unlinked');
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
Route::get('organisatoren/index', [OrganizerController::class, 'index'])->name('organizers.index');
Route::get('organisatoren/search', [OrganizerController::class, 'search'])->name('organizers.search');
Route::get('organisator/{organizer}', [OrganizerController::class, 'organizer'])->name('organizers.organizer');

// Acties aanmelden
Route::get('acties/aanmelden', [ReportController::class, 'landing'])->name('report.landing');

// Blog routes
Route::get('blog/index', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{category}', [BlogController::class, 'category'])->name('blog.category');
Route::get('blog/{category}/{post}', [BlogController::class, 'post'])->name('blog.post');

// General page route
Route::get('{page}', [PageController::class, 'page'])->name('page');

// Routes that require authemtication
Route::group(['prefix' => 'auth', 'middleware' => ['auth', 'xss']], function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/getStats', [DashboardController::class, 'getStats'])->name('dashboard.stats');

    // Acties aanmelden (authenticated)
    Route::get('aanmelden/view/{id}', [ReportController::class, 'view'])->name('report.view');
    Route::post('aanmelden/form/create', [ReportController::class, 'create'])->name('report.create');

    // Settings
    Route::get('settings/{section?}', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings/profile', [SettingsController::class, 'profilePut'])->name('settings.profile.put');
    Route::post('settings/profile/deleteAvatar/{id}', [SettingsController::class, 'deleteAvatar'])->name('settings.profile.deleteAvatar');
    Route::put('settings/security', [SettingsController::class, 'securityPut'])->name('settings.security.put');

    // Notifications & Announcements
    Route::get('notifications', [NotificationController::class, 'get'])->name('notifications');
    // Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements');
    // Route::get('announcement/{id}', [AnnouncementController::class, 'announcement'])->name('announcement');
    // Route::post('announcements/read', [AnnouncementController::class, 'read'])->name('announcements.read');
    Route::post('notification/read/{id}', [NotificationController::class, 'read'])->name('notification.read');
});
