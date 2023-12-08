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
use App\Http\Controllers\ActieWijzerController;
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
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\WidgetController;

// Authentication routes
Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('user/verify/{verification_code}', [RegisterController::class, 'verify'])->name('verify');
Route::get('register/complete', [RegisterController::class, 'complete'])->name('registration.complete');

// Include voyager routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('report/approve/{id}', [ReportController::class, 'approve'])->name('report.approve');
    Route::get('organizer/approve/{id}', [OrganizerController::class, 'approve'])->name('organizer.approve');
    Route::get('actie/publish/{id}', [ActieController::class, 'publish'])->name('actie.publish');
    Route::get('organizer/publish/{id}', [OrganizerController::class, 'publish'])->name('organizer.publish');
    Route::post('images/delete_unlinked', [ImageController::class, 'deleteUnlinked'])->name('images.delete_unlinked');
});

// Wave impersonation route
Route::impersonate();

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Translation file route
Route::get('/lang-{lang}.js', [LanguageController::class, 'show']);

// Acties & Organizers
Route::get('acties', [ActieController::class, 'agenda'])->name('acties.agenda');
Route::get('acties/search', [ActieController::class, 'search'])->name('acties.search');
Route::get('actie/{actie}', [ActieController::class, 'actie'])->name('acties.actie');
Route::get('organisatoren/index', [OrganizerController::class, 'index'])->name('organizers.index');
Route::get('organisatoren/search', [OrganizerController::class, 'search'])->name('organizers.search');
Route::get('organisator/{organizer}', [OrganizerController::class, 'organizer'])->name('organizers.organizer');

// Acties aanmelden
Route::get('acties/aanmelden', [ReportController::class, 'landing'])->name('report.landing');

// ActieWijzer
Route::get('actiewijzer', [ActieWijzerController::class, 'landing'])->name('actiewijzer.landing');
Route::get('actiewijzer/result', [ActieWijzerController::class, 'landing'])->name('actiewijzer.result');


// Public statistics route
Route::get('dashboard/getPublicStats', [DashboardController::class, 'getPublicStats'])->name('dashboard.public_stats');

// Blog routes
Route::get('blog/index', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{category}', [BlogController::class, 'category'])->name('blog.category');
Route::get('blog/{category}/{post}', [BlogController::class, 'post'])->name('blog.post');

// Newsletter (subscriber) routes
Route::get('nieuwsbrief', [SubscriberController::class, 'landing'])->name('subscribers.landing');
Route::post('subscriber/create', [SubscriberController::class, 'store'])->name('subscribers.store');
Route::get('subscriber/delete', [SubscriberController::class, 'delete'])->name('subscribers.delete');
Route::get('subscriber/verify/{id}/{hash}', [SubscriberController::class, 'verify'])->name('subscribers.verify');
Route::get('subscriber/verified', [SubscriberController::class, 'verified'])->name('subscribers.verified');

// Widget route
Route::get('widget', [WidgetController::class, 'index'])->name('widget');

// General page route
Route::get('{page}', [PageController::class, 'page'])->name('page');

// Routes that require authentication
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
    Route::post('notification/read/{id}', [NotificationController::class, 'read'])->name('notification.read');
});
