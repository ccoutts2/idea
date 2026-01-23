<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

test('it logs in a user', function (): void {
    $user = User::factory()->create(['email' => 'j@mail.com', 'password' => 'password']);

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'password')
        ->click('@login-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();
});

test('it logs out a user', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user);

    visit('/')->click("Log Out");

    $this->assertGuest();
}); 

test('it requires a valid email', function (): void {
    $user = User::factory()->create(['email' => 'j@mail.com', 'password' => 'password']);

    visit('/login')
        ->fill('email', 'j@mail')
        ->fill('password', $user->password)
        ->click('@login-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();    
});