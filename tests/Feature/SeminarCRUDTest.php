<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Seminar;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeminarCRUDTest extends TestCase
{
    public function test_api_failed_to_get_all_seminars() {
        
        $errors = [
            "message"=> "Unauthenticated.",
        ];
        $response = $this->getJson('/api/seminars', $errors);
        
        $response->assertStatus(401);
        $response->assertJson($errors);
    }
    
    public function test_api_failed_to_get_a_seminar() {
        Sanctum::actingAs(User::factory()->create());
        
        $errors = [
            "message"=> 'No query results for model [App\\Models\\Seminar] 1',
        ];

        $response = $this->getJson('/api/seminars/1');
        
        $response->assertStatus(404);
        $response->assertJson($errors);
    }
    
    public function test_api_failed_to_add_seminar() {
        Sanctum::actingAs(User::factory()->create());
        
        $errors = [
            "status" => false,
            "message"=> "Error adding data",
        ];
        $response = $this->postJson('/api/seminars', $errors);
        
        $response->assertStatus(400);
        $response->assertJson($errors);
    }

    public function test_api_failed_to_update_a_seminar() {
        Sanctum::actingAs(User::factory()->create());
        
        $errors = [
            "message"=> 'No query results for model [App\\Models\\Seminar] 1',
        ];
        $response = $this->putJson('/api/seminars/1', $errors);
        
        $response->assertStatus(404);
        $response->assertJsonFragment($errors);
    }
    
    public function test_api_failed_to_delete_seminar() {
        Sanctum::actingAs(User::factory()->create());

        $errors = [
            "message"=> 'No query results for model [App\\Models\\Seminar] 1',
        ];
        $response = $this->deleteJson('/api/seminars/1', $errors);
        
        $response->assertStatus(404);
        $response->assertJsonFragment($errors);
    }

    public function test_api_successfully_add_a_seminar() {
        Sanctum::actingAs(User::factory()->create());

        $data = [
            'name' => 'ddd',
            'slug' => 'ddd',
            'description' => 'ddd',
            'max_participants' => 22,
            'current_participants' => 1,
            'open_until' => "2024-11-06",
            'start_time' => "2024-11-06",
            'end_time' => "2024-11-06",
            'venue' => 'Kabupaten p',
        ];
        $response = $this->post('/api/seminars', $data);

        $response->assertStatus(201);
        $response->assertJson(["data" => $data]);
     }

     public function test_api_successfully_update_a_seminar() {
        Sanctum::actingAs(User::factory()->create());
        
        $seminar = [
            'name' => 'ddd',
            'slug' => 'ddd',
            'description' => 'ddd',
            'max_participants' => 22,
            'current_participants' => 1,
            'open_until' => "2024-11-06",
            'start_time' => "2024-11-06",
            'end_time' => "2024-11-06",
            'venue' => 'Kabupaten p',
        ];
        $response = $this->putJson('/api/seminars/5', $seminar);

        $response->assertStatus(200);
        $response->assertJson(["data" => $seminar]);
    }

    public function test_api_successfully_get_all_seminars() {
        Sanctum::actingAs(User::factory()->create());
        
        $seminars = Seminar::latest()->get();
        $response = $this->getJson('/api/seminars');
        
        $response->assertJson([
            "data" => $seminars->toArray(),
        ]);
    }
    
    public function test_api_successfully_get_a_seminar() {
        Sanctum::actingAs(User::factory()->create());
        
        $seminar = Seminar::where('id', 5)->get();
        $response = $this->getJson('/api/seminars/5');
        
        $response->assertStatus(200);
        $response->assertJsonFragment($seminar->toArray());
    }

    
    public function test_api_successfully_delete_seminar() {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->deleteJson('/api/seminars/9');
        
        $response->assertStatus(200);
        $response->assertJson([
            'message' => "Successfully delete a seminar"
        ]);
    }
}
    