<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can register', function () {
    $response = $this->post(route('auth.signup'), [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect(route('home'));
    $this->assertDatabaseHas('users', [
        'email' => 'johndoe@example.com',
    ]);
});

test('user can register as a family head', function () {
    $response = $this->post(route('auth.signup'), [
        'name' => 'John Doe',
        'email' => 'johndoe2@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'is_head' => true
    ]);

    $response->assertRedirect(route('family.create'));
    $this->assertDatabaseHas('users', [
        'email' => 'johndoe2@example.com',
        'is_head' => true,
    ]);
});

test('user can login', function () {
   $user = \App\Models\User::factory()->create([
       'password' => bcrypt('password')
   ]);

   $response = $this->post(route('auth.login'), [
       'email' => $user->email,
       'password' => 'password'
   ]);

   $response->assertRedirect(route('home'));
});

test('user cannot login with invalid credentials', function () {
    $user = \App\Models\User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post(route('auth.login'), [
        'email' => $user->email,
        'password' => 'dindimakasa7bitamalk7bkhhdhfh',
    ]);

    $response->assertRedirect(route('auth.login.form'));

    $response->assertSessionHas('status', 'Invalid password, please try again');
});

test('user can logout', function () {
    $user = \App\Models\User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('auth.login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('home'));

    $response = $this->post(route('auth.logout'));

    $response->assertRedirect(route('auth.login.form'));

    $this->assertGuest();
});
