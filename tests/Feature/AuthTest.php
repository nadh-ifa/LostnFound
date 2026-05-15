<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_with_valid_data()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'User Test',
            'email' => 'usertest@ub.ac.id',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => 'usertest@ub.ac.id',
        ]);
    }

    public function test_user_can_login()
    {
        User::factory()->create([
            'email' => 'usertest@ub.ac.id',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'usertest@ub.ac.id',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_login_fails_with_wrong_password()
    {
        User::factory()->create([
            'email' => 'usertest@ub.ac.id',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'usertest@ub.ac.id',
            'password' => 'salah',
        ]);

        $response->assertStatus(401);
    }
}