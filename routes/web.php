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
use App\Http\Controllers\ICalController;
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

// Custom admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('report/approve/{id}', [ReportController::class, 'approve'])->name('report.approve');
    Route::get('organizer/approve/{id}', [OrganizerController::class, 'approve'])->name('organizer.approve');
    Route::get('actie/publish/{id}', [ActieController::class, 'publish'])->name('actie.publish');
    Route::get('organizer/publish/{id}', [OrganizerController::class, 'publish'])->name('organizer.publish');
    Route::post('images/delete_unlinked', [ImageController::class, 'deleteUnlinked'])->name('images.delete_unlinked');
    Route::post('actiewijzer/score_dimension', [ActieWijzerController::class, 'scoreDimension'])->name('actiewijzer.score_dimension');
    Route::post('actiewijzer/delete_dimension_score', [ActieWijzerController::class, 'deleteDimensionScore'])->name('actiewijzer.delete_dimension_score');
    Route::post('actiewijzer/answer/edit', [ActieWijzerController::class, 'editAnswer'])->name('actiewijzer.answer.edit');
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
Route::get('actie/{slug}', [ActieController::class, 'actie'])->name('acties.actie');
Route::get('actie/{slug}/ics', [ICalController::class, 'actie'])->name('ical.actie');

Route::get('organisatoren/index', [OrganizerController::class, 'index'])->name('organizers.index');
Route::get('organisatoren/search', [OrganizerController::class, 'search'])->name('organizers.search');
Route::get('organisator/{organizer}', [OrganizerController::class, 'organizer'])->name('organizers.organizer');

// Acties aanmelden
Route::get('acties/aanmelden', [ReportController::class, 'landing'])->name('report.landing');

// ActieWijzer
Route::get('actiewijzer', [ActieWijzerController::class, 'landing'])->name('actiewijzer.landing');
Route::get('actiewijzer/result', [ActieWijzerController::class, 'result'])->name('actiewijzer.result');
Route::get('type/{referentie_type}', [ActieWijzerController::class, 'referentie_type'])->name('actiewijzer.referentie_type');
Route::get('referenties/search', [ActieWijzerController::class, 'search'])->name('referenties.search');


// Newsletter (subscriber) routes
Route::get('nieuwsbrief', [SubscriberController::class, 'landing'])->name('subscribers.landing');
Route::post('subscriber/create', [SubscriberController::class, 'store'])->name('subscribers.store');
Route::get('subscriber/delete', [SubscriberController::class, 'delete'])->name('subscribers.delete');
Route::get('subscriber/verify/{id}/{hash}', [SubscriberController::class, 'verify'])->name('subscribers.verify');
Route::get('subscriber/verified', [SubscriberController::class, 'verified'])->name('subscribers.verified');

// iCal route
Route::get('ical/feed', [ICalController::class, 'generate'])->name('ical.feed');

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

    // Notifications
    Route::post('notification/read/{id}', [NotificationController::class, 'read'])->name('notification.read');
});
