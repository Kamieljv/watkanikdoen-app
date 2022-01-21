<?php

Route::impersonate();

Route::get('/', '\Wave\Http\Controllers\HomeController@index')->name('wave.home');
Route::get('@{username}', '\Wave\Http\Controllers\ProfileController@index')->name('wave.profile');

// Translation file route
Route::get('/lang-{lang}.js', '\Wave\Http\Controllers\LanguageController@show');

// Documentation routes
Route::view('docs/{page?}', 'docs::index')->where('page', '(.*)');

// Additional Auth Routes
Route::get('logout', 'Auth\LoginController@logout')->name('wave.logout');
Route::get('user/verify/{verification_code}', 'Auth\RegisterController@verify')->name('verify');
Route::post('register/complete', '\Wave\Http\Controllers\Auth\RegisterController@complete')->name('wave.register-complete');

Route::get('acties/search', '\Wave\Http\Controllers\ActieController@search')->name('wave.acties.search');
Route::get('actie/{actie}', '\Wave\Http\Controllers\ActieController@actie')->name('wave.acties.actie');

Route::get('organizer/{organizer}', '\Wave\Http\Controllers\OrganizerController@organizer')->name('wave.organizers.organizer');

Route::get('blog', '\Wave\Http\Controllers\BlogController@index')->name('wave.blog');
Route::get('blog/{category}', '\Wave\Http\Controllers\BlogController@category')->name('wave.blog.category');
Route::get('blog/{category}/{post}', '\Wave\Http\Controllers\BlogController@post')->name('wave.blog.post');

/***** Pages *****/
Route::get('{page}', '\Wave\Http\Controllers\PageController@page')->name('wave.page');

/***** Pricing Page *****/
Route::view('pricing', 'theme::pricing')->name('wave.pricing');

/***** Billing Routes *****/
Route::post('/billing/webhook', '\Wave\Http\Controllers\WebhookController@handleWebhook');
Route::post('paddle/webhook', '\Wave\Http\Controllers\SubscriptionController@hook');
Route::post('checkout', '\Wave\Http\Controllers\SubscriptionController@checkout')->name('checkout');

Route::get('test', '\Wave\Http\Controllers\SubscriptionController@test');

Route::group(['prefix' => 'auth', 'middleware' => 'auth'], function () {
    Route::get('dashboard', '\Wave\Http\Controllers\DashboardController@index')->name('wave.dashboard');

    Route::get('settings/{section?}', '\Wave\Http\Controllers\SettingsController@index')->name('wave.settings');

    Route::post('settings/profile', '\Wave\Http\Controllers\SettingsController@profilePut')->name('wave.settings.profile.put');
    Route::put('settings/security', '\Wave\Http\Controllers\SettingsController@securityPut')->name('wave.settings.security.put');

    Route::post('settings/api', '\Wave\Http\Controllers\SettingsController@apiPost')->name('wave.settings.api.post');
    Route::put('settings/api/{id?}', '\Wave\Http\Controllers\SettingsController@apiPut')->name('wave.settings.api.put');
    Route::delete('settings/api/{id?}', '\Wave\Http\Controllers\SettingsController@apiDelete')->name('wave.settings.api.delete');

    Route::get('settings/invoices/{invoice}', '\Wave\Http\Controllers\SettingsController@invoice')->name('wave.invoice');

    Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
    Route::get('announcements', '\Wave\Http\Controllers\AnnouncementController@index')->name('wave.announcements');
    Route::get('announcement/{id}', '\Wave\Http\Controllers\AnnouncementController@announcement')->name('wave.announcement');
    Route::post('announcements/read', '\Wave\Http\Controllers\AnnouncementController@read')->name('wave.announcements.read');
    Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
    Route::post('notification/read/{id}', '\Wave\Http\Controllers\NotificationController@delete')->name('wave.notification.read');

    /********** Checkout/Billing Routes ***********/
    Route::post('cancel', '\Wave\Http\Controllers\SubscriptionController@cancel')->name('wave.cancel');
    Route::view('checkout/welcome', 'theme::welcome');

    Route::post('subscribe', '\Wave\Http\Controllers\SubscriptionController@subscribe')->name('wave.subscribe');
    Route::view('trial_over', 'theme::trial_over')->name('wave.trial_over');
    Route::view('cancelled', 'theme::cancelled')->name('wave.cancelled');
    Route::post('switch-plans', '\Wave\Http\Controllers\SubscriptionController@switchPlans')->name('wave.switch-plans');
});
