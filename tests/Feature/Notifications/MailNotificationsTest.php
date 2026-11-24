<?php

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Actie;
use App\Models\ContactMessage;
use App\Models\Feedback;
use App\Models\Organizer;
use App\Models\Report;
use App\Models\Subscriber;
use App\Models\User;
use App\Notifications\Mail\ErrorAlert;
use App\Notifications\Mail\InboxMessageReceived;
use App\Notifications\Mail\PasswordReset;
use App\Notifications\Mail\ReportAccepted;
use App\Notifications\Mail\ReportReceived;
use App\Notifications\Mail\SubscriberVerifyEmail;
use App\Notifications\Mail\VerifyEmail;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->withoutMiddleware([VerifyCsrfToken::class, ThrottleRequests::class]);
});

/**
 * All visible text of a mail, in order.
 */
function mailText(MailMessage $mail): string
{
    return implode("\n", array_filter([
        $mail->subject,
        $mail->greeting,
        ...$mail->introLines,
        $mail->actionText,
        ...$mail->outroLines,
        $mail->salutation,
    ]));
}

/**
 * Checks that hold for every e-mail: it is sent by mail, renders, and every text comes from the lang files.
 */
function assertWellFormedMail($notification, $notifiable): MailMessage
{
    expect($notification->via($notifiable))->toContain('mail');

    $mail = $notification->toMail($notifiable);
    $html = (string) $mail->render();

    expect(mailText($mail))
        // Untranslated keys show up as the key itself
        ->not->toMatch('/\b(emails|reports|notifications)\.[a-z_]+/')
        ->and($html)->toContain('<html')
        ->and($mail->subject)->toEndWith(' | ' . config('app.name'));

    return $mail;
}

describe('PasswordReset', function () {

    it('contains the reset link', function () {
        $mail = assertWellFormedMail(new PasswordReset('token-123'), new AnonymousNotifiable());

        expect($mail->subject)->toBe(__('emails.password_reset.subject') . ' | ' . config('app.name'))
            ->and($mail->greeting)->toBe(__('emails.greeting') . ',')
            ->and($mail->introLines)->toBe([__('emails.password_reset.intro')])
            ->and($mail->actionText)->toBe(__('emails.password_reset.action'))
            ->and($mail->actionUrl)->toBe(url('password/reset', 'token-123'))
            ->and($mail->outroLines)->toBe([__('emails.password_reset.outro')])
            ->and($mail->salutation)->toBe(__('emails.salutation'));
    });

    it('is sent when a user requests a password reset', function () {
        Notification::fake();
        $user = User::factory()->create();

        $this->post(route('password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, PasswordReset::class);
    });

});

describe('VerifyEmail', function () {

    it('contains the verification link and expiry', function () {
        $user = User::factory()->make(['name' => 'Jan', 'verification_code' => 'code-123']);

        $mail = assertWellFormedMail(new VerifyEmail($user), new AnonymousNotifiable());

        expect($mail->subject)->toBe(__('emails.verify_email.subject') . ' | ' . config('app.name'))
            ->and($mail->greeting)->toBe(__('emails.greeting') . ' Jan,')
            ->and($mail->introLines)->toBe([
                __('emails.verify_email.intro'),
                __('emails.verify_email.expires', ['count' => config('auth.verification.expire')]),
            ])
            ->and($mail->actionText)->toBe(__('emails.verify_email.action'))
            ->and($mail->actionUrl)->toBe(url('/user/verify/code-123'))
            ->and($mail->salutation)->toBe(__('emails.salutation'));
    });

    it('is sent on registration when e-mail verification is on', function () {
        Notification::fake();
        config(['app.verify_email' => true]);
        Role::create(['name' => config('permission.default_role'), 'guard_name' => 'web']);

        $this->post(route('register'), [
            'name' => 'Jan',
            'email' => 'jan@example.com',
            'password' => 'een-lang-wachtwoord',
            'password_confirmation' => 'een-lang-wachtwoord',
        ]);

        Notification::assertSentOnDemand(
            VerifyEmail::class,
            fn ($notification, $channels, $notifiable) => $notifiable->routes['mail'] === 'jan@example.com'
                && $notification->user->email === 'jan@example.com',
        );
    });

    it('is not sent on registration when e-mail verification is off', function () {
        Notification::fake();
        config(['app.verify_email' => false]);
        Role::create(['name' => config('permission.default_role'), 'guard_name' => 'web']);

        $this->post(route('register'), [
            'name' => 'Jan',
            'email' => 'jan@example.com',
            'password' => 'een-lang-wachtwoord',
            'password_confirmation' => 'een-lang-wachtwoord',
        ]);

        Notification::assertNothingSent();
    });

});

describe('SubscriberVerifyEmail', function () {

    it('contains a working, signed verification link', function () {
        $subscriber = Subscriber::factory()->create(['email_verified_at' => null]);

        $mail = assertWellFormedMail(new SubscriberVerifyEmail(), $subscriber);

        expect($mail->subject)->toBe(__('emails.newsletter_verify.subject') . ' | ' . config('app.name'))
            ->and($mail->greeting)->toBe(__('emails.newsletter_verify.greeting'))
            ->and($mail->introLines)->toBe([
                __('emails.newsletter_verify.intro'),
                __('emails.newsletter_verify.instruction'),
            ])
            ->and($mail->actionText)->toBe(__('emails.newsletter_verify.action'))
            ->and($mail->outroLines)->toBe([__('emails.newsletter_verify.outro')])
            ->and($mail->actionUrl)->toContain('signature=');

        $this->get($mail->actionUrl);

        expect($subscriber->fresh()->email_verified_at)->not->toBeNull();
    });

    it('is sent when someone subscribes to the newsletter', function () {
        Notification::fake();
        config(['newsletter.verify' => true]);

        $this->postJson(route('subscribers.store'), ['email' => 'lezer@example.com'])->assertCreated();

        Notification::assertSentTo(Subscriber::firstWhere('email', 'lezer@example.com'), SubscriberVerifyEmail::class);
    });

});

describe('ReportReceived', function () {

    it('links to the reports in the admin panel', function () {
        $mail = assertWellFormedMail(new ReportReceived(User::factory()->make()), new AnonymousNotifiable());

        expect($mail->subject)->toBe(__('emails.report_received.subject') . ' | ' . config('app.name'))
            ->and($mail->greeting)->toBe(__('emails.greeting_admin') . ',')
            ->and($mail->introLines)->toBe([__('emails.report_received.message')])
            ->and($mail->actionText)->toBe(__('emails.report_received.action'))
            ->and($mail->actionUrl)->toBe(config('app.url') . '/admin/reports')
            ->and($mail->salutation)->toBe(__('emails.salutation'));
    });

    it('is sent to the admin when an actie is reported', function () {
        Notification::fake();
        config(['app.debug' => false]);
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $reporter = User::factory()->create();

        $this->actingAs($reporter)->postJson(route('report.create'), [
            'userId' => $reporter->id,
            'organizers' => [],
            'report' => [
                'title' => 'Klimaatmars',
                'body' => '<p>Loop mee!</p>',
                'actionUrls' => ['https://example.com'],
                'start_date' => now()->addDay()->format('Y-m-d'),
                'end_date' => now()->addDay()->format('Y-m-d'),
                'location_human' => 'Utrecht',
            ],
        ])->assertJson(['status' => 'success']);

        Notification::assertSentTo($admin, ReportReceived::class);
        Notification::assertNotSentTo($reporter, ReportReceived::class);
    });

});

describe('ReportAccepted', function () {

    function pendingReport(User $reporter): Report
    {
        $organizer = Organizer::factory()->create(['status' => 'PUBLISHED']);

        return Report::factory()->create([
            'user_id' => $reporter->id,
            'organizer_ids' => (string) $organizer->id,
            'status' => 'PENDING',
            'start_date' => now()->addDay()->format('Y-m-d'),
            'end_date' => now()->addDay()->format('Y-m-d'),
        ]);
    }

    it('links to the new actie', function () {
        $reporter = User::factory()->create(['name' => 'Jan']);
        $actie = Actie::factory()->create(['user_id' => $reporter->id, 'title' => 'Klimaatmars']);

        $mail = assertWellFormedMail(new ReportAccepted($actie), $reporter);

        expect($mail->subject)->toBe(__('emails.report_accepted.subject') . ' | ' . config('app.name'))
            ->and($mail->greeting)->toBe(__('emails.greeting') . ' Jan,')
            ->and($mail->introLines)->toBe([__('emails.report_accepted.message', ['title' => 'Klimaatmars'])])
            ->and($mail->actionText)->toBe(__('emails.report_accepted.action'))
            ->and($mail->actionUrl)->toBe(config('app.url') . '/actie/' . $actie->slug)
            ->and($mail->salutation)->toBe(__('emails.salutation'));
    });

    it('is sent to the reporter when their report is approved, once', function () {
        Notification::fake();
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $reporter = User::factory()->create();
        $report = pendingReport($reporter);

        $this->actingAs($admin)->get(route('report.approve', $report->id))->assertRedirect();

        Notification::assertSentToTimes($reporter, ReportAccepted::class, 1);
        expect((bool) $report->fresh()->reporter_notified)->toBeTrue();
    });

});

describe('InboxMessageReceived', function () {

    it('describes a contact message', function () {
        $message = ContactMessage::create([
            'name' => 'Jane', 'email' => 'jane@example.com', 'subject' => 'Vraag', 'message' => "Regel 1\nRegel 2",
        ]);

        $mail = assertWellFormedMail(new InboxMessageReceived($message), new AnonymousNotifiable());

        expect($mail->subject)->toBe(__('emails.inbox.contact_subject') . ' | ' . config('app.name'))
            ->and($mail->greeting)->toBe(__('emails.greeting_admin') . ',')
            ->and($mail->introLines[0])->toBe(__('emails.inbox.contact_intro'))
            ->and(mailText($mail))->toContain('Jane')->toContain('Vraag')->toContain('Regel 1')->toContain('Regel 2')
            ->and($mail->actionText)->toBe(__('emails.inbox.action'))
            ->and($mail->actionUrl)->toContain('/contact-messages/' . $message->id)
            ->and($mail->replyTo)->toBe([['jane@example.com', null]]);
    });

    it('describes anonymous feedback', function () {
        $feedback = Feedback::create(['message' => 'Mooie site!']);

        $mail = assertWellFormedMail(new InboxMessageReceived($feedback), new AnonymousNotifiable());

        expect($mail->subject)->toBe(__('emails.inbox.feedback_subject') . ' | ' . config('app.name'))
            ->and($mail->introLines[0])->toBe(__('emails.inbox.feedback_intro'))
            ->and(mailText($mail))->toContain(__('emails.inbox.unknown'))
            // Markdown-escaped in the source ("site\!"), plain text once rendered
            ->and((string) $mail->render())->toContain('Mooie site!')
            ->and($mail->actionUrl)->toContain('/feedback/' . $feedback->id)
            ->and($mail->replyTo)->toBe([]);
    });

});

describe('ErrorAlert', function () {

    it('contains the exception details', function () {
        $notification = new ErrorAlert([
            'class' => RuntimeException::class,
            'message' => 'Er ging iets mis',
            'file' => '/app/Foo.php',
            'line' => 42,
            'traceback' => '#0 {main}',
        ]);

        expect($notification->via(new AnonymousNotifiable()))->toBe(['mail']);
        $mail = $notification->toMail(new AnonymousNotifiable());
        (string) $mail->render();

        // The only e-mail without the " | app" subject suffix
        expect($mail->subject)->toBe(__('emails.error_alert.subject', ['app' => config('app.name')]))
            ->and($mail->greeting)->toBe(__('emails.greeting_admin') . ',')
            ->and(mailText($mail))
            ->not->toMatch('/\bemails\.[a-z_]+/')
            ->toContain(RuntimeException::class)
            ->toContain('Er ging iets mis')
            ->toContain('/app/Foo.php')
            ->toContain('42')
            ->toContain('#0 {main}');
    });

});
