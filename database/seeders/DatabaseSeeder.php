<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        
        // Create sample trips
        $audioFiles = [
            'meditation_nature.mp3',
            'meditation_breathing.mp3',
            'meditation_mindfulness.mp3',
        ];
        
        foreach ($audioFiles as $index => $audioFile) {
            $trip = \App\Models\Trip::create([
                'user_id' => $user->id,
                'start_time' => now()->subDays($index + 1),
                'end_time' => now()->subDays($index + 1)->addMinutes(10),
                'duration' => 600,
                'satisfaction' => rand(3, 5),
                'audio_file' => $audioFile,
            ]);
            
            \App\Models\VoiceSession::create([
                'trip_id' => $trip->id,
                'audio_file' => $audioFile,
                'duration' => 600,
            ]);
            
            \App\Models\Comment::create([
                'trip_id' => $trip->id,
                'user_id' => $user->id,
                'content' => 'This was a wonderful meditation session!',
            ]);
        }
    }
}
