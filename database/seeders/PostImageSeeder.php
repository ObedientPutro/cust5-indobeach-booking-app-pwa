<?php

namespace Database\Seeders;

use App\Models\PostImage;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostImage::insert([
            [ 'post_id' => '1', 'image_path' => 'images/posts/1-1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '1', 'image_path' => 'images/posts/1-2.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '1', 'image_path' => 'images/posts/1-3.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '1', 'image_path' => 'images/posts/1-4.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '2', 'image_path' => 'images/posts/2-1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'image_path' => 'images/posts/2-2.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'image_path' => 'images/posts/2-3.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'image_path' => 'images/posts/2-4.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '3', 'image_path' => 'images/posts/3-1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '3', 'image_path' => 'images/posts/3-2.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '3', 'image_path' => 'images/posts/3-3.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '3', 'image_path' => 'images/posts/3-4.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
        ]);
    }
}
