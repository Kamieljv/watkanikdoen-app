<?php

use App\Models\User;

test('available routes', function ($url) {

    $appURL = env('APP_URL');

    $response = $this->get($url);

    $response->assertStatus(200);
})->with('routes');

test('available auth routes', function ($url) {

    $user = User::find(1);

    $this->actingAs($user);

    $appURL = env('APP_URL');

    $response = $this->get($url);

    $response->assertStatus(200);
})->with('authroutes');
