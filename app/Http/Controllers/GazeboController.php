<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GazeboController extends Controller
{
    public function index() {
        $posts = Post::where('status', PostStatus::Published)->latest('created_at')->with(['images', 'category', 'amenities'])->paginate(10);

        return Inertia::render('Gazebo/GazeboList', [
            'posts' => $posts,
        ]);
    }

    public function detail(string $id) {
        return Inertia::render('Gazebo/GazeboDetail');
    }
}
