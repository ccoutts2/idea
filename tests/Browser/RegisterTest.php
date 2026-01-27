<?php

use Illuminate\Support\Facades\Auth;

test('it registers a user', function (): void {
    visit('/register')
        ->fill('name', 'Jon Doe')
        ->fill('email', 'j@mail.com')
        ->fill('password', 'password')
        ->click('Create Account')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'Jon Doe',
        'email' => 'j@mail.com',
    ]);
});
