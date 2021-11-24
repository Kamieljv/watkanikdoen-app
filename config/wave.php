<?php

return [
	// Whenever you want to dynamically create a new user profile field such as 
	// about, social_links, or any other field you will need to include the field 
	// name in this config.
	'profile_fields' => [
		'about'
	],

	// in minutes
	'api' => [
		'auth_token_expires' 	=> 60,
		'key_token_expires'		=> 1,
	],

	'auth' => [
		'min_password_length' => 10,
	],

	// This is the default user model of your application.
	'user_model' => App\User::class,

	// Set these to false in production
	'show_docs' => env('WAVE_DOCS', true),
    'dev_bar' => env('WAVE_BAR', true),

	// This is primarily used for demo purposes of the Wave project, 
	//in your project you will probably want to set this to false (unless you want 
	//to test out some of the demo functionality).
	'demo' => env('WAVE_DEMO', false),

	// for billing
    'paddle' => [
        'vendor' => env('PADDLE_VENDOR_ID', ''),
        'auth_code' => env('PADDLE_VENDOR_AUTH_CODE', ''),
        'env' => env('PADDLE_ENV', 'sandbox')
    ]

];
