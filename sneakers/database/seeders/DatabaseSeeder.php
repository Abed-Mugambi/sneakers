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

        
        \App\Models\Product::factory()->count(50)->create();
        \App\Models\Reviews::factory()->count(300)->create();


        // factory(\App\Models\Product::class, 50)->create();
        // factory(\App\Models\Reviews::class, 300)->create();
    }
}
