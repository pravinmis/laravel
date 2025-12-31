<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        User::all()->each(function ($user) {
            Order::factory()->count(rand(1,5))->for($user)->create();
        // Order::factory()->count(10)->create();
    });
}
}