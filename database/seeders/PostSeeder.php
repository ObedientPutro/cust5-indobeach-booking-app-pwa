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
                'title' => 'small gazebo type 1',
                'description' => "Our Type 1 Gazebo is the perfect spot for intimate gatherings. Located right on the sand, it offers a direct view of the ocean, making it ideal for relaxing and enjoying the beach atmosphere with shade and comfort.\n\nExperience the best of the beach from our classic Type 1 Gazebo. This cozy, wooden structure is situated just steps from the shoreline, providing an unobstructed view of the waves under the shade of a coconut palm. It comes equipped with a built-in table and bench seating, perfect for enjoying a meal, reading a book, or simply watching the day go by. With its prime location and simple charm, it's a favorite choice for couples and small families.",
                'price' => 300000,
                'quantity' => 3,
                'quantity_left' => 3,
                'status' => PostStatus::Published,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'title' => 'medium gazebo type 1',
                'description' => "Our Medium Gazebo Type 1 is a two-story structure offering an elevated view of the beach. With its traditional wooden design, roll-up bamboo blinds for privacy, and decorative lighting, it's perfect for larger groups or families looking for a spacious and comfortable all-day retreat.\n\nElevate your beach experience in our Medium Gazebo Type 1. This unique, two-level gazebo provides ample space and a superior vantage point to enjoy the stunning coastal scenery. The lower level offers a shaded gathering area, while the upper deck, accessible from within, provides a more private space with beautiful ocean views. The natural wood construction, complemented by traditional bamboo blinds and charming woven lanterns, creates an authentic tropical ambiance perfect for group gatherings.",
                'price' => 650000,
                'quantity' => 2,
                'quantity_left' => 2,
                'status' => PostStatus::Published,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'title' => 'large gazebo type 1',
                'description' => "Ideal for events and large family gatherings, our Large Gazebo Type 1 offers a spacious, sheltered area. Featuring a polished tile floor, high wooden ceilings, and ample lighting, this gazebo provides a comfortable and versatile space for any occasion, day or night.\n\nHost your next event in our premier Large Gazebo Type 1. This expansive, open-air pavilion is our largest available facility, designed to accommodate big groups with ease. The cool, polished flooring and high, slatted wood ceiling create a breezy and elegant atmosphere. It's furnished with sturdy wooden tables and equipped with overhead lighting and woven pendant lamps, making it perfectly suited for daytime celebrations or evening parties by the beach.",
                'price' => 900000,
                'quantity' => 1,
                'quantity_left' => 1,
                'status' => PostStatus::Published,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'title' => 'cottage type 1',
                'description' => "Step into our rustic Cottage Type 1, featuring a unique A-frame design. Relax on your private covered terrace, complete with comfortable seating. The large glass doors not only brighten the interior but also offer beautiful views, making it a perfect private getaway.\n\nDiscover the unique charm of our Cottage Type 1. Its distinctive A-frame architecture and natural wood finish create a cozy, cabin-like atmosphere perfect for your beach holiday. Enjoy your morning coffee or an evening breeze on the spacious, covered front porch. With large glass doors, this cottage is designed to blend indoor comfort with the beauty of the outdoors, offering a memorable and secluded retreat.",
                'price' => 600000,
                'quantity' => 5,
                'quantity_left' => 5,
                'status' => PostStatus::Published,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3,
                'title' => 'camping type 1',
                'description' => "Our Type 1 Camping Shelter offers a spacious, covered area perfect for day-use. With its distinctive A-frame roof and open-air design, it provides excellent shade and a place to gather, store your belongings, or enjoy a picnic while being protected from the sun.\n\nEnjoy the outdoors with the comfort of our Type 1 Camping Pavilion. This structure features a high, triangular roof for maximum airflow and a sturdy wooden platform, keeping you elevated from the sand. The open design allows you to feel the refreshing beach breeze, while the decorative lattice work adds a touch of local charm. It's the perfect home base for your day at the beach, offering a reliable shelter for relaxation and group activities.",
                'price' => 400000,
                'quantity' => 6,
                'quantity_left' => 6,
                'status' => PostStatus::Published,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
