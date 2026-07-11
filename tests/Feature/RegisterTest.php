<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\post;

dataset('users', [
    fn() => User::factory()->create(['name' => 'Jack', 'email' => 'jack@example.com', 'password' => 'password123!@#'])
]);

dataset('registers', [
    ['name' => 'Lucy', 'email' => 'lucy@example.com', 'password' => 'password123!@#'],
]);

it('creates a user', function (User $user): void {
    actingAs($user)->assertAuthenticated();

    assertDatabaseHas('users', $user->only(['name', 'email', 'password']));
})->with('users');

it('can\'t registers a user without a name', function () {
    post('/register', [
        'name' => '',
        'email' => 'jack@example.com',
        'password' => 'password123!@#'
    ])->assertSessionHasErrors('name');

    assertDatabaseMissing('users', [
        'name' => '',
        'email' => 'jack@example.com'
    ]);
});

it('can\'t registers a user without a valid email', function () {
    post('/register', [
        'name' => 'Jack',
        'email' => 'jackexample.com',
        'password' => 'password123!@#'
    ])->assertSessionHasErrors('email');

    assertDatabaseMissing('users', [
        'name' => 'Jack',
        'email' => 'jackexample.com'
    ]);
});

it('can\'t registers a user with a password less than 8 characters', function () {
    post('/register', [
        'name' => 'Jack',
        'email' => 'jack@example.com',
        'password' => 'jack1!'
    ])->assertSessionHasErrors('password');

    assertDatabaseMissing('users', [
        'name' => 'Jack',
        'email' => 'jack@example.com'
    ]);
});

it('registers a user redirecting him to home page', function (string $name, string $email, string $password): void {
    post('/register', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
    ])->assertRedirect('/');

    assertDatabaseHas('users', [
        'name' => $name,
        'email' => $email,
    ]);
})->with('registers');
