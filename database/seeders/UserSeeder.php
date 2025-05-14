<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                "name" => "indobeach owner",
                "email" => "indobeach@gmail.com",
                "password" => bcrypt("password"),
                "role" => UserRole::Owner,
                "phone_number" => "081343123232",
                "address" => "Lalumpe, Kombi, Minahasa Regency, North Sulawesi",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "name" => "obedient putro",
                "email" => "obedputro@gmail.com",
                "password" => bcrypt("password"),
                "role" => UserRole::Customer,
                "phone_number" => "081343547590",
                "address" => "Wawalintouan, Kec. Tondano Barat",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
