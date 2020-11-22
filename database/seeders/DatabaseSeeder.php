<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory(1)->create([
                'name' => 'Test Lab',
                'email' => 'test@test.com',
                'password' => \Hash::make('12345')
            ]);
            User::factory(20)->create();
        PostCategory::factory(10)->create();
        Post::factory(500)->create();
    }
}
