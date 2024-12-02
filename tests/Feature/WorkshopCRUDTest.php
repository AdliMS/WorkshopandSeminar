<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Workshop;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkshopCRUDTest extends TestCase
{
    public function test_api_failed_to_get_all_workshops() {
        
        $errors = [
            "message"=> "Unauthenticated.",
        ];
        $response = $this->getJson('/api/workshops', $errors);
        
        $response->assertStatus(401);
        $response->assertJson($errors);
    }
    
    public function test_api_failed_to_get_a_workshop() {
        Sanctum::actingAs(User::factory()->create());
        
        $errors = [
            "message"=> 'No query results for model [App\\Models\\Workshop] 1',
        ];

        $response = $this->getJson('/api/workshops/1');
        
        $response->assertStatus(404);
        $response->assertJson($errors);
    }
    
    public function test_api_failed_to_add_workshop() {
        Sanctum::actingAs(User::factory()->create());
        
        $errors = [
            "status" => false,
            "message"=> "Error adding data",
        ];
        $response = $this->postJson('/api/workshops', $errors);
        
        $response->assertStatus(400);
        $response->assertJson($errors);
    }

    public function test_api_failed_to_update_a_workshop() {
        Sanctum::actingAs(User::factory()->create());
        
        $errors = [
            "message"=> 'No query results for model [App\\Models\\Workshop] 1',
        ];
        $response = $this->putJson('/api/workshops/1', $errors);
        
        $response->assertStatus(404);
        $response->assertJsonFragment($errors);
    }
    
    public function test_api_failed_to_delete_workshop() {
        Sanctum::actingAs(User::factory()->create());

        $errors = [
            "message"=> 'No query results for model [App\\Models\\Workshop] 1',
        ];
        $response = $this->deleteJson('/api/workshops/1', $errors);
        
        $response->assertStatus(404);
        $response->assertJsonFragment($errors);
    }

    public function test_api_successfully_get_all_workshops() {
        Sanctum::actingAs(User::factory()->create());
        
        $workshops = Workshop::latest()->get();
        $response = $this->getJson('/api/workshops');
        
        $response->assertJson([
            "data" => $workshops->toArray(),
        ]);
    }
    
    public function test_api_successfully_get_a_workshop() {
        Sanctum::actingAs(User::factory()->create());
        
        $workshop = Workshop::where('id', 9)->get();
        $response = $this->getJson('/api/workshops/9');
        
        $response->assertJsonFragment($workshop);
    }

    public function test_api_successfully_add_a_workshop() {
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
        $response = $this->post('/api/workshops', $data);

        $response->assertStatus(201);
        $response->assertJson(["data" => $data]);
     }

     public function test_api_successfully_update_a_workshop() {
        Sanctum::actingAs(User::factory()->create());
        
        $workshop = [
            'name' => 'ddd',
            'slug' => 'ddd',
            'description' => 'ddd',
            'max_participants' => 22,
            'current_participants' => 1,
            'open_until' => "2024-11-06",
            'start_time' => "2024-11-06",
            'end_time' => "2024-11-06",
            'venue' => 'Kabupaten p',
            'category_id' => 1,
        ];
        $response = $this->putJson('/api/workshops/6', $workshop);

        $response->assertStatus(200);
        $response->assertJson(["data" => $workshop]);
    }
    
    public function test_api_successfully_delete_workshop() {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->deleteJson('/api/workshops/11');
        
        $response->assertStatus(200);
        $response->assertJson([
            'message' => "Successfully delete a workshop"
        ]);
    }
}
