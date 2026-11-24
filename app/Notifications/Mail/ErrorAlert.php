<?php

namespace App\Notifications\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ErrorAlert extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($exception)
    {
        $this->exception = $exception;
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
        $app = config('app.name');

        return (new MailMessage())
                    ->subject(__('emails.error_alert.subject', ['app' => $app]))
                    ->greeting(__('emails.greeting_admin') . ',')
                    ->line(__('emails.error_alert.intro', ['app' => $app]))
                    ->line(__('emails.error_alert.class') . ': ' . $this->exception['class'])
                    ->line(__('emails.error_alert.message') . ': ' . $this->exception['message'])
                    ->line(__('emails.error_alert.file') . ': ' . $this->exception['file'] . ' (' . __('emails.error_alert.line') . ' ' . $this->exception['line'] . ')')
                    ->line(__('emails.error_alert.trace') . ': ' . $this->exception['traceback']);
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
