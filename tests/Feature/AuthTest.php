<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $userData = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->post(route('auth.signup'), $userData);

        $response->assertRedirect(route('auth.login'))
            ->assertSessionHas('success', 'Account created successfully');

        $this->assertDatabaseHas('users', ['email' => 'test@test.com']);
    }

    public function test_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('dashboard'))
            ->assertSessionHas('success', 'Logged in');

        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create();

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => 'wrongpassword'
        ]);

        $response->assertRedirect(route('auth.login'))
            ->assertSessionHas('error', 'Invalid credentials, try again');

        $this->assertGuest();
    }

    public function test_authenticated_user_can_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('auth.logout'));

        $response->assertRedirect(route('auth.login'))
            ->assertSessionHas('success', 'Logged out');

        $this->assertGuest();
    }

    public function test_guest_cannot_logout()
    {
        $response = $this->post(route('auth.logout'));

        $response->assertRedirect(route('auth.login'))
            ->assertSessionHas('error', 'You are not logged in');
    }
}