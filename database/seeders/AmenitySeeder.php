<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Amenity::create([
            "name" => "bath",
            "icon_path" => "images\icons\bathup.png"
        ]);

        Amenity::create([
            "name" => "bed",
            "icon_path" => "images\icons\bed.png"
        ]);

        Amenity::create([
            "name" => "chair",
            "icon_path" => "images\icons\chair.png"
        ]);

        Amenity::create([
            "name" => "electricity",
            "icon_path" => "images\icons\electricity.png"
        ]);

        Amenity::create([
            "name" => "grill",
            "icon_path" => "images\icons\grill.png"
        ]);

        Amenity::create([
            "name" => "restaurant",
            "icon_path" => "images\icons\restaurant.png"
        ]);

        Amenity::create([
            "name" => "table",
            "icon_path" => "images\icons\table.png"
        ]);

        Amenity::create(attributes: [
            "name" => "wifi",
            "icon_path" => "images\icons\wifi.png"
        ]);
    }
}
