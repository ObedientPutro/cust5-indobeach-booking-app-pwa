<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::insert([
            [
                'category_id' => 1,
                'title' => 'gazebo type 1',
                'description' => 'Untuk 8 orang',
                'price' => 500000,
                'quantity' => 5,
                'quantity_left' => 5,
                'status' => PostStatus::Draft,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'title' => 'gazebo type 2',
                'description' => 'Untuk 5 orang',
                'price' => 400000,
                'quantity' => 7,
                'quantity_left' => 7,
                'status' => PostStatus::Draft,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'title' => 'cottage type 1',
                'description' => 'Untuk 9 orang',
                'price' => 900000,
                'quantity' => 6,
                'quantity_left' => 6,
                'status' => PostStatus::Draft,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
