<?php

namespace App\Listeners;

use App\Models\Actie;
use App\Notifications\ReportAccepted;

class NotifyReporterOfApproval
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->dataType->name === 'acties') {
            $actie = Actie::find($event->data->id);
            $report = $actie->report;
            if ($event->data->status === "PUBLISHED" && $report) {
                if (!$report->reporter_notified) {
                    // Notify the user that issued the report
                    $report->user->notify(new ReportAccepted($actie));

                    $report->reporter_notified = 1;
                    $report->save();
                }
            }
        }
    }
}
