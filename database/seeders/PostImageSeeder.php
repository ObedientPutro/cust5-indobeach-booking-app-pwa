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
            [ 'post_id' => '1', 'image_path' => 'images/posts/gazebo_type_1_1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '1', 'image_path' => 'images/posts/gazebo_type_1_2.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '1', 'image_path' => 'images/posts/gazebo_type_1_3.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '1', 'image_path' => 'images/posts/gazebo_type_1_4.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '2', 'image_path' => 'images/posts/gazebo_type_2_1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'image_path' => 'images/posts/gazebo_type_2_2.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'image_path' => 'images/posts/gazebo_type_2_3.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'image_path' => 'images/posts/gazebo_type_2_4.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'image_path' => 'images/posts/gazebo_type_2_5.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '3', 'image_path' => 'images/posts/gazebo_type_3_1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '3', 'image_path' => 'images/posts/gazebo_type_3_2.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '3', 'image_path' => 'images/posts/gazebo_type_3_3.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '4', 'image_path' => 'images/posts/cottage_type_1_1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'image_path' => 'images/posts/cottage_type_1_2.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'image_path' => 'images/posts/cottage_type_1_3.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'image_path' => 'images/posts/cottage_type_1_4.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'image_path' => 'images/posts/cottage_type_1_5.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '5', 'image_path' => 'images/posts/camping_type_1_1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '5', 'image_path' => 'images/posts/camping_type_1_2.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '5', 'image_path' => 'images/posts/camping_type_1_3.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '5', 'image_path' => 'images/posts/camping_type_1_4.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '5', 'image_path' => 'images/posts/camping_type_1_5.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '5', 'image_path' => 'images/posts/camping_type_1_6.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '5', 'image_path' => 'images/posts/camping_type_1_7.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
        ]);
    }
}
