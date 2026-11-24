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
            // Texts: resources/lang/nl/emails.php (newsletter_verify)
        ]
    ]
];
