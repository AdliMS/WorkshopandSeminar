<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_api_user_failed_to_login() {

        $errors = [
            'status' => false,
            'message' => 'Validation Error',
        ];
        $response = $this->postJson('/api/login', $errors);

        $response->assertStatus(401);
        $response->assertJsonFragment($errors);
    }

    public function test_api_user_failed_to_logout() {

        $errors = [
            "message"=> "Unauthenticated.",
        ];
        $response = $this->postJson('/api/logout', $errors);

        $response->assertStatus(401);
        $response->assertJsonFragment($errors);
    }

    public function test_api_user_successfully_logged_in() {

        $user = [
            'name' => 'admin',
            'password' => 'admin',
        ];

        $response = $this->postJson('/api/login', $user);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "status" => true,
            "message" => "User logged in successfully.",
        ]);
    }

    public function test_api_user_successfully_logged_out() {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200);
        $response->assertJson([]);
    }
}
