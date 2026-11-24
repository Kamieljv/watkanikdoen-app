<?php

namespace App\Notifications\Mail;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Filament\Resources\Feedback\FeedbackResource;
use App\Models\ContactMessage;
use App\Models\Feedback;
use App\Services\MailTextSanitizer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Notifies the admin of a new contact message or feedback submission.
 *
 * Everything in it comes from an anonymous web form, so every value goes through MailTextSanitizer:
 * the mail contains plain, inert text only (no HTML, Markdown, clickable links or header injection).
 */
class InboxMessageReceived extends Notification
{
    use Queueable;

    public function __construct(public ContactMessage|Feedback $inboxMessage)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = $this->inboxMessage;
        $type = $message instanceof ContactMessage ? 'contact' : 'feedback';
        $resource = $message instanceof ContactMessage ? ContactMessageResource::class : FeedbackResource::class;
        $unknown = __('emails.inbox.unknown');

        $name = MailTextSanitizer::line($message->name) ?: $unknown;
        $email = MailTextSanitizer::email($message->email);
        $subject = MailTextSanitizer::line($message->subject) ?: $unknown;

        $mail = (new MailMessage())
            // Fixed subject: user input never ends up in a mail header
            ->subject(__("emails.inbox.{$type}_subject") . ' | ' . config('app.name'))
            ->greeting(__('emails.greeting_admin') . ',')
            ->line(__("emails.inbox.{$type}_intro"))
            ->line('**' . __('emails.inbox.name') . ':** ' . $name)
            ->line('**' . __('emails.inbox.email') . ':** ' . (MailTextSanitizer::line($email) ?: $unknown))
            ->line('**' . __('emails.inbox.subject') . ':** ' . $subject)
            ->line('**' . __('emails.inbox.message') . ':**');

        foreach (MailTextSanitizer::lines($message->message) as $line) {
            $mail->line($line);
        }

        $mail->action(
            __('emails.inbox.action'),
            $resource::getUrl('view', ['record' => $message], panel: 'admin'),
        )->salutation(__('emails.salutation'));

        // Lets the admin answer directly; only a validated address, and the name stays out of the header
        if ($email) {
            $mail->replyTo($email);
        }

        return $mail;
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
