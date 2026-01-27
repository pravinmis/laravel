<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
                 // dd($user);
            Post::factory()->count(rand(1,4))->for($user)->create();
            // ya: Post::factory()->count(rand(1,5))->create(['user_id' => $user->id]);
        });

    
    }
}
