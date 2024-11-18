<?php

namespace Database\Seeders;

use App\Models\User;

use App\Models\Seminar;
use App\Models\Workshop;
use App\Models\EventCategory;
use App\Models\EventStatus;
use App\Models\ParticipantRequirement;
use App\Models\Registration;
use App\Models\Participant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(1)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
        ]);

             

        // Seminar::factory(8)->recycle([
        //     EventStatus::factory(3)->create(),   
        //     EventCategory::factory(4)->create(),
        //     Speaker::factory(4)->create(),
        // ])->create();     

        // Workshop::factory(5)->recycle([
        //     EventStatus::factory(3)->create(),   
        //     EventCategory::factory(4)->create(),
        //     Speaker::factory(4)->create(),
        // ])->create();    

        // Seminar::factory(10)->recycle([
        //     EventStatus::factory(3)->create(),
        //     EventCategory::factory(5)->create(),
        //     Speaker::factory(5)->create(),
        //     // ParticipantRequirement::factory(10)->create()
        // ])->create();
        
        // Workshop::factory(10)->recycle([
        //     EventStatus::factory(3)->create(),
        //     EventCategory::factory(5)->create(),
        //     Speaker::factory(5)->create(),
        //     // ParticipantRequirement::factory(10)->create()
        // ])->create();

           
            Workshop::factory(1)->create();

            Workshop::factory(2)->recycle([
                EventStatus::factory(2)->create(),
                EventCategory::factory(3)->create(),
            ])->create();

   

    }   
}
