<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Amenity::insert([
            [
                'name' => 'bath',
                'icon_path' => 'images\icons\amenity\bathup.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'bed',
                'icon_path' => 'images\icons\amenity\bed.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'chair',
                'icon_path' => 'images\icons\amenity\chair.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'electricity',
                'icon_path' => 'images\icons\amenity\electricity.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'grill',
                'icon_path' => 'images\icons\amenity\grill.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'restaurant',
                'icon_path' => 'images\icons\amenity\restaurant.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'table',
                'icon_path' => 'images\icons\amenity\table.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'wifi',
                'icon_path' => 'images\icons\amenity\wifi.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
