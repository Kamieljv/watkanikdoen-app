<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Notifications\Notification as BaseNotification;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Notification;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * Send a notification to the admin e-mail address (config app.admin_email).
     * A failing mail server must never break the request, so errors are only reported.
     */
    protected function notifyAdmin(BaseNotification $notification): void
    {
        try {
            Notification::route('mail', config('app.admin_email'))->notify($notification);
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
