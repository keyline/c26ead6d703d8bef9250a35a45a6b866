<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AdminsTableSeeder::class,
            ServiceSeeder::class,
            ServiceTypeSeeder::class,
            ServiceAttributeSeeder::class,
            GeneralSettingSeeder::class,
        ]);

        //Creating 50 students
        \App\Models\StudentProfile::factory(50)->create();

        \App\Models\MentorProfile::factory(50)->create();



    }
}
