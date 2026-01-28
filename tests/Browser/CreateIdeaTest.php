<?php

use App\Models\Idea;
use App\Models\User;

it('creates a new idea', function () {
    $this->actingAs($user = User::factory()->create());

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'idea1')
        ->click('@button-status-completed')
        ->fill('description', 'example description')
        ->fill('@new-link', 'https://www.google.com')
        ->click('@submit-new-link-button')
        ->fill('@new-link', 'https://www.youtube.com')
        ->click('@submit-new-link-button')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'idea1',
        'status' => 'completed',
        'description' => 'example description',
        'links' => ['https://www.google.com', 'https://www.youtube.com'],
    ]);
});

it('fails to create a new idea', function () {
    $this->actingAs(User::factory()->create());

    visit('/ideas')
        ->click('@create-idea-button')
        ->click('@button-status-pending')
        ->fill('description', 'empty title')
        ->fill('@new-link', 'https://www.google.com')
        ->click('@submit-new-link-button')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect(Idea::count())->toBe(0);
});
