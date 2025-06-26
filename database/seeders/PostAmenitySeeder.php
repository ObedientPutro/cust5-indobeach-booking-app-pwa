<?php

namespace Database\Seeders;

use App\Models\PostAmenity;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostAmenity::insert([
            [ 'post_id' => '1', 'amenity_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '1', 'amenity_id' => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '1', 'amenity_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '1', 'amenity_id' => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '2', 'amenity_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'amenity_id' => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'amenity_id' => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'amenity_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '2', 'amenity_id' => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '3', 'amenity_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '3', 'amenity_id' => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '3', 'amenity_id' => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '3', 'amenity_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '3', 'amenity_id' => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '4', 'amenity_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'amenity_id' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'amenity_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'amenity_id' => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'amenity_id' => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'amenity_id' => '6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'amenity_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '4', 'amenity_id' => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],

            [ 'post_id' => '5', 'amenity_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '5', 'amenity_id' => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '5', 'amenity_id' => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            [ 'post_id' => '5', 'amenity_id' => '8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
        ]);
    }
}
