<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Enums\PostStatus;
use App\Http\Requests\Gazebo\IndexGazeboRequest;
use App\Models\Amenity;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Inertia\Inertia;

class GazeboController extends Controller
{
    public function index(IndexGazeboRequest $request) {
        $searchFilter = $request->input('search');
        $categoryFilters = $request->input('categories', []);
        $amenityFilters = $request->input('amenities', []);

        $postsQuery = Post::query()
            ->where('status', PostStatus::Published)
            ->with(['images', 'category', 'amenities']);

        if ($searchFilter) {
            $postsQuery->where('title', 'like', '%' . $searchFilter . '%');
        }

        if (!empty($categoryFilters)) {
            $postsQuery->whereIn('category_id', $categoryFilters);
        }

        if (!empty($amenityFilters)) {
            $postsQuery->whereHas('amenities', function ($query) use ($amenityFilters) {
                $query->whereIn('tb_m_amenities.id', $amenityFilters);
            }, '>=', count($amenityFilters));
        }

        $posts = $postsQuery->latest('created_at')->paginate(6)->withQueryString();

        return Inertia::render('Gazebo/List/GazeboList', [
            'posts' => $posts,
            'categories' => Category::all(),
            'amenities' => Amenity::all(),
            'filters' => [
                'search' => $searchFilter,
                'categories' => $categoryFilters,
                'amenities' => $amenityFilters
            ],
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
