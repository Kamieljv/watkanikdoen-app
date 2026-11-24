<?php

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutMiddleware([VerifyCsrfToken::class, ThrottleRequests::class]);
    // Submissions e-mail the admin (InboxMessageReceived, tested in tests/Feature/Notifications)
    Notification::fake();
});

function validContactMessage(array $overrides = []): array
{
    return array_merge([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'subject' => 'Question about acties',
        'message' => 'How do I add an actie?',
    ], $overrides);
}

describe('Contact form', function () {

    it('stores a contact message', function () {
        $response = $this->post(route('contact.store'), validContactMessage());

        $response->assertSessionHas('success', __('contact.success'));

        $this->assertDatabaseHas('contact_messages', validContactMessage());
    });

    it('returns json when submitted from the vue component', function () {
        $response = $this->postJson(route('contact.store'), validContactMessage());

        $response->assertCreated()->assertJson(['status' => 'created']);

        expect(ContactMessage::count())->toBe(1);
    });

    it('allows the subject to be empty', function () {
        $this->postJson(route('contact.store'), validContactMessage(['subject' => null]))
            ->assertCreated();

        $this->assertDatabaseHas('contact_messages', ['subject' => null]);
    });

    it('requires a name, email and message', function (string $field) {
        $this->postJson(route('contact.store'), validContactMessage([$field => null]))
            ->assertUnprocessable()
            ->assertJsonValidationErrors($field);

        expect(ContactMessage::count())->toBe(0);
    })->with(['name', 'email', 'message']);

    it('validates email addresses', function () {
        $this->postJson(route('contact.store'), validContactMessage(['email' => 'not-an-email']))
            ->assertJsonValidationErrors('email');

        expect(ContactMessage::count())->toBe(0);
    });

    it('does not accept messages longer than 5000 characters', function () {
        $this->postJson(route('contact.store'), validContactMessage(['message' => str_repeat('a', 5001)]))
            ->assertJsonValidationErrors('message');

        expect(ContactMessage::count())->toBe(0);
    });

    it('requires an hcaptcha token in production', function () {
        app()->detectEnvironment(fn () => 'production');

        $this->postJson(route('contact.store'), validContactMessage())
            ->assertUnprocessable()
            ->assertJsonValidationErrors('h-captcha-token');

        expect(ContactMessage::count())->toBe(0);
    });

    it('shows the form on the contact page only', function () {
        $author = User::factory()->create();
        foreach (['contact', 'over-ons'] as $slug) {
            Page::create([
                'author_id' => $author->id,
                'title' => ucfirst($slug),
                'slug' => $slug,
                'body' => '<p>Body</p>',
                'status' => 'PUBLISHED',
            ]);
        }

        $this->get(route('page', 'contact'))
            ->assertOk()
            // Kebab-case: the browser lowercases in-DOM tags, so <MessageForm> would not resolve
            ->assertSee('<message-form', false)
            ->assertSee('type="contact"', false);

        $this->get(route('page', 'over-ons'))
            ->assertOk()
            ->assertDontSee('<message-form', false);
    });

});
