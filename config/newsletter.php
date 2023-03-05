<?php
return [
    'verify' => env('LARAVEL_SUBSCRIBERS_VERIFY', true),
    'redirect_url' => 'home',
    /*
     |--------------------------------------------------------------------------
     | Notifications Mail Messages
     |--------------------------------------------------------------------------
     |
     */
    'mail' => [
        'verify' => [
            'expiration' => 60, // in minutes
            'subject' => 'Bevestigen inschrijving nieuwsbrief | Watkanikdoen.nl',
            'greeting' => 'Hello!',
            'content' => [
                'You have registered for our newsletter with this email address.',
                'Please click the button below to verify your email address.'
            ],
            'action' => 'Verify Email Address',
            'footer' => [
                'If you did not sign up for our newsletter, no further action is required.'
            ],
        ]
    ]
];
