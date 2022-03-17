<?php

namespace App\Notifications;

use App\Models\Actie;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReportAccepted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Actie $actie)
    {
        $this->actie = $actie;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => __('reports.accepted_notif_title'),
            'icon' => 'bell',
            'body' => __('reports.accepted_notif_body', ['title' => $this->actie->title]),
            'link' => route('acties.actie', $this->actie->slug),
        ];
    }
}
