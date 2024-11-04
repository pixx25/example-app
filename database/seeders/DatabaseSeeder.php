<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function($user) {
            // Create posts for each user
            $user->posts()->saveMany(
                Post::factory(3)->make()
            )->each(function($post) {
                // Create comments for each post
                $post->comments()->saveMany(
                    Comment::factory(2)->make([
                        'user_id' => User::inRandomOrder()->first()->id,
                    ])
                );
            });
        });
    }
}
