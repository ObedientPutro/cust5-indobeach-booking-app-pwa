<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Cottage",
            "icon_path" => "Charming beachfront cottage with ocean views, cozy interiors, and direct access to sandy shores—perfect for serene seaside escapes."
        ]);

        Category::create([
            "name" => "Staycation",
            "icon_path" => "Relaxing staycation in a cozy beach cottage—ocean breezes, stunning sunsets, and tranquil vibes just steps from the shore."
        ]);
    }
}
