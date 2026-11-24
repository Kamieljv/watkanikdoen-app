<?php

namespace App\Notifications\Mail;

use App\Models\Actie;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReportAccepted extends Notification
{
    use Queueable;

    public Actie $actie;
    public User $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Actie $actie)
    {
        $this->actie = $actie;
        $this->user = User::find($actie->user_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
            'body' => __('reports.accepted_notif_body', ['title' => $this->actie->title]),
            'link' => route('acties.actie', $this->actie->slug),
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = config('app.url') . '/actie/' . $this->actie->slug;

        return (new MailMessage())
                    ->subject(__("emails.report_accepted.subject") . ' | ' . config('app.name'))
                    ->greeting(__("emails.greeting") . ' ' . $this->user->name . ',')
                    ->line(__("emails.report_accepted.message", ['title' => $this->actie->title]))
                    ->action(__("emails.report_accepted.action"), $url)
                    ->salutation(__('emails.salutation'));
    }
}
