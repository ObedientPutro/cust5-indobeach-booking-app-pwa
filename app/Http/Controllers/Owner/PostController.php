<?php

namespace App\Http\Controllers\Owner;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Inertia\Inertia;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest('created_at')->with(['images', 'category'])->paginate(10);

        return Inertia::render('Owner/Post/PostList', [
            "posts" => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = collect(PostStatus::cases())->map(function ($status) {
            return [
                'id' => $status->value,
                'name' => $status->name,
            ];
        });

        return Inertia::render('Owner/Post/PostForm', [
            'categories' => Category::all(),
            'amenities' => Amenity::all(),
            'statuses' => $statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $this->postService->create($request);

        return redirect()->route('admin.post.index')->with('success', 'Post '. $request->title .' created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('Owner/Post/PostPreview', [
            'post' => $post->load(['images', 'category', 'amenities']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $statuses = collect(PostStatus::cases())->map(function ($status) {
            return [
                'id' => $status->value,
                'name' => $status->name,
            ];
        });

        return Inertia::render('Owner/Post/PostForm', [
            'post' => $post->load(['category', 'images', 'amenities']),
            'categories' => Category::all(),
            'amenities' => Amenity::all(),
            'statuses' => $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->postService->update($request, $post);

        return redirect()->route('admin.post.index')->with('success', 'Post '. $request->title .' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postService->delete($post);

        return redirect()->route('admin.post.index')->with('success', 'Post '. $post->title .' deleted successfully');
    }
}
