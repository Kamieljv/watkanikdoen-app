<?php

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\ContactMessage;
use App\Models\Feedback;
use App\Notifications\Mail\InboxMessageReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutMiddleware([VerifyCsrfToken::class, ThrottleRequests::class]);
});

describe('Admin notification for contact messages and feedback', function () {

    it('notifies the admin of a new contact message', function () {
        Notification::fake();

        $this->postJson(route('contact.store'), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'subject' => 'Vraag',
            'message' => 'Hoe voeg ik een actie toe?',
        ])->assertCreated();

        Notification::assertSentOnDemand(
            InboxMessageReceived::class,
            fn ($notification, $channels, $notifiable) => $notifiable->routes['mail'] === config('app.admin_email')
                && $notification->inboxMessage->is(ContactMessage::first()),
        );
    });

    it('notifies the admin of new feedback', function () {
        Notification::fake();

        $this->postJson(route('feedback.store'), ['message' => 'Mooie site!'])->assertCreated();

        Notification::assertSentOnDemand(
            InboxMessageReceived::class,
            fn ($notification) => $notification->inboxMessage->is(Feedback::first()),
        );
    });

    it('still stores the message when sending the mail fails', function () {
        Notification::shouldReceive('route')->andThrow(new RuntimeException('SMTP down'));

        $this->postJson(route('feedback.store'), ['message' => 'Mooie site!'])->assertCreated();

        expect(Feedback::count())->toBe(1);
    });

    it('renders malicious input as inert text', function () {
        $message = ContactMessage::create([
            'name' => '<img src=x onerror=alert(1)>Mallory',
            'email' => 'mallory@example.com',
            'subject' => "Hallo\r\nBcc: victim@example.com",
            'message' => "<script>alert('xss')</script>\n[Klik hier](https://evil.example/login)\n![pixel](https://evil.example/track.png)\n# Grote kop\n<a href=\"https://evil.example\">link</a>",
        ]);

        $mail = (new InboxMessageReceived($message))->toMail(new AnonymousNotifiable());
        $html = (string) $mail->render();

        expect($html)
            ->not->toContain('<script')
            ->not->toContain('onerror')
            ->not->toContain('evil.example')
            // Only the greeting is a heading; the user's "# Grote kop" is not
            ->not->toMatch('/<h[1-6][^>]*>\s*Grote kop/')
            ->toContain('# Grote kop')
            ->not->toMatch('/<img[^>]+evil/')
            ->toContain('Mallory')
            ->and($mail->subject)->not->toContain('Bcc')
            ->and($mail->replyTo)->toBe([['mallory@example.com', null]]);

        // The only link to evil.example would be the defanged text; the only real link is the admin panel
        preg_match_all('/href="([^"]+)"/', $html, $links);
        foreach ($links[1] as $link) {
            expect($link)->not->toContain('evil');
        }
    });

});
