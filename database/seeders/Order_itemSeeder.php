<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Order_item;

class Order_itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Order::all()->each(function ($order) {
            Order_item::factory()->count(rand(1,5))->for($order)->create();
            // ya: Post::factory()->count(rand(1,5))->create(['user_id' => $user->id]);
        });
    }
}
