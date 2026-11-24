<?php

use App\Models\Feedback;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutMiddleware([VerifyCsrfToken::class, ThrottleRequests::class]);
    // Submissions e-mail the admin (InboxMessageReceived, tested in tests/Feature/Notifications)
    Notification::fake();
});


describe('Feedback form', function () {

    it('allows visitors to submit feedback', function () {
        $response = $this->post(route('feedback.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Website suggestion',
            'message' => 'I really like your website!',
        ]);

        $response->assertSessionHas(
            'success',
            'Bedankt voor je feedback!'
        );

        $this->assertDatabaseHas('feedback', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Website suggestion',
            'message' => 'I really like your website!',
        ]);
    });

    it('allows optional fields to be empty', function () {
        $response = $this->post(route('feedback.store'), [
            'message' => 'Just wanted to say hello!',
        ]);

        $this->assertDatabaseHas('feedback', [
            'name' => null,
            'email' => null,
            'subject' => null,
            'message' => 'Just wanted to say hello!',
        ]);
    });

    it('requires a message', function () {
        $response = $this->post(route('feedback.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Website suggestion',
        ]);

        $response->assertSessionHasErrors('message');

        expect(Feedback::count())->toBe(0);
    });

    it('validates email addresses', function () {
        $response = $this->post(route('feedback.store'), [
            'name' => 'John Doe',
            'email' => 'not-an-email',
            'subject' => 'Website suggestion',
            'message' => 'Some feedback.',
        ]);

        $response->assertSessionHasErrors('email');

        expect(Feedback::count())->toBe(0);
    });

    it('does not accept messages longer than 5000 characters', function () {
        $response = $this->post(route('feedback.store'), [
            'message' => str_repeat('a', 5001),
        ]);

        $response->assertSessionHasErrors('message');

        expect(Feedback::count())->toBe(0);
    });

    it('returns json when submitted from the feedback component', function () {
        $response = $this->postJson(route('feedback.store'), [
            'message' => 'Submitted via the Vue form.',
        ]);

        $response->assertCreated()->assertJson(['status' => 'created']);

        $this->assertDatabaseHas('feedback', [
            'message' => 'Submitted via the Vue form.',
        ]);
    });

    it('requires an hcaptcha token in production', function () {
        app()->detectEnvironment(fn () => 'production');

        $response = $this->postJson(route('feedback.store'), [
            'message' => 'No captcha here.',
        ]);

        $response->assertUnprocessable()->assertJsonValidationErrors('h-captcha-token');

        expect(Feedback::count())->toBe(0);
    });

    it('shows the feedback page', function () {
        $this->get(route('feedback.create'))
            ->assertOk()
            ->assertSee('<message-form', false)
            ->assertSee('type="feedback"', false);
    });

});