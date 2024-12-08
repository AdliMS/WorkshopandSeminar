<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(4),
            'type' => 'seminar',
            'slug' => Str::slug(fake()->sentence(3)),
            'description' => fake()->text(200),
            'max_participants' => fake()->randomNumber(3, true),
     
            'open_until' => fake()->dateTime(),
            'start_time' => fake()->dateTime(),
            'end_time' => fake()->dateTime(),
            'venue' => 'Kabupaten '.fake()->sentence(1),
            
            // 'speaker_id' => Speaker::factory(),
            // 'status_id' => EventStatus::factory(),
            // 'category_id' => EventCategory::factory(),
        ];
    }
}
