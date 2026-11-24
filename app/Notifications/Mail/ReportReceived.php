<?php

namespace App\Notifications\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportReceived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $user)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = config('app.url') . '/admin/reports';

        return (new MailMessage())
                    ->subject(__("emails.report_received.subject") . ' | ' . config('app.name'))
                    ->greeting(__("emails.greeting_admin") . ',')
                    ->line(__("emails.report_received.message"))
                    ->action(__("emails.report_received.action"), $url)
                    ->salutation(__('emails.salutation'));
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
            //
        ];
    }
}
