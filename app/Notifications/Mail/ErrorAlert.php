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
        return (new MailMessage())
                    ->subject("[ALERT] Critical error on " . config('app.name'))
                    ->greeting(__("Dear") . "admin" . ',')
                    ->line("A critical error occurred on the production server (app: " . config('app.name') . ").")
                    ->line("Class: " . $this->exception['class'])
                    ->line("Message: " . $this->exception['message'])
                    ->line("File: " . $this->exception['file'] . " on line " . $this->exception['line'])
                    ->line("Stack trace: " . $this->exception['traceback']);
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
