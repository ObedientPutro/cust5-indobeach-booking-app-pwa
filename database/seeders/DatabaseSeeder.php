<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('app:copy-backup-to-storage');

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            AmenitySeeder::class,
            PostSeeder::class,
            PostImageSeeder::class,
            PostAmenitySeeder::class,
        ]);
    }
}
