<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Enums\PostStatus;
use App\Models\Booking;
use App\Models\Post;
use Carbon\Carbon;
use Inertia\Inertia;

class GazeboController extends Controller
{
    public function index() {
        $posts = Post::where('status', PostStatus::Published)->latest('created_at')->with(['images', 'category', 'amenities'])->paginate(10);

        return Inertia::render('Gazebo/List/GazeboList', [
            'posts' => $posts,
        ]);
    }

    public function detail(Post $post) {

        $post->load(['images', 'category', 'amenities', 'bookings']);

        $statuses = [
            BookingStatus::Cancelled,
            BookingStatus::Rejected,
            BookingStatus::Completed,
        ];

        $today = Carbon::today();

        $user = auth()->user();
        $booking = null;

        if ($user) {
            $booking = $post->bookings()
                ->where('user_id', $user->id)
                ->WhereNotIn('status', $statuses)
                ->whereDate('start_date', '>=', $today)
                ->whereDate('end_date', '>=', $today)
                ->first();
        }

        return Inertia::render('Gazebo/Detail/GazeboDetail', [
            'post' => $post,
            'booking' => $booking,
        ]);
    }
}
