<?php

use App\Models\Feedback;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutMiddleware(VerifyCsrfToken::class);
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

});