<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
            //without seeder
        //     User::factory(10)->create();
        //       User::all()->each(function ($user) {
        //     Post::factory()->count(rand(1,5))->for($user)->create();
        //     // ya: Post::factory()->count(rand(1,5))->create(['user_id' => $user->id]);
        // });



           //  without seeder & factory
        //    User::factory()->create([
        //     'name' => 'Niharika ji',
        //     'email' => 'hello@example.com',
        // ]);
         

        //  with seeder and factory
            $this->call([
            // UsersTableSeeder::class,
            // PostsTableSeeder::class,

            Order_itemSeeder::class,
            OrderSeeder::class
        ]);
    }
}
