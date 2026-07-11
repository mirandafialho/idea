<?php

use App\Models\User;
use function Pest\Laravel\post;

dataset('user', [
    fn() => User::factory()->create(['name' => 'Jane', 'email' => 'jane@example.com', 'password' => 'password123!@#'])
]);

it('log in a user', function (User $user) {
    post('/login', [
        'email' => $user->email,
        'password' => $user->password,
    ])->assertRedirect('/');
})->with('user');

it('can\'t log in with invalid password', function (User $user): void {
    post('/login', [
        'email' => $user->email,
        'password' => 'invalidpassword',
    ])->assertSessionHasErrors('password');
})->with('user');
