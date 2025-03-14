<?php

namespace App\Http\Controllers\Owner;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostAmenity;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;

class PostController extends Controller
{
    private $image_path = 'images/posts';

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
        $categories = Category::all();
        $amenities = Amenity::all();
        $statuses = PostStatus::cases();

        $statuses = collect($statuses)->map(function ($status) {
            return [
                'id' => $status->value,
                'name' => $status->name,
            ];
        });

        return Inertia::render('Owner/Post/PostForm', [
            'categories' => $categories,
            'amenities' => $amenities,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:255|unique:'.Post::class,
            'description' => 'required|string',
            'price' => 'required|integer|min:1000',
            'category_id' => 'required|exists:'.Category::class.',id',
            'quantity' => 'required|numeric|min:1',
            'status' => ['required', new Enum(PostStatus::class)],
            'selected_amenities' => 'required|array|min:1',
            'selected_amenities.*' => 'required|exists:'.Amenity::class.',id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'selected_amenities.required' => 'Please select at least one amenities.',
            'images.required' => 'Please upload at least one image.',
            'images.*.image' => 'Only image files are allowed.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post = Post::create([
            'category_id' => $request->category_id,
            'title' => strtolower($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'quantity_left' => $request->quantity,
            'status' => $request->status,
        ]);

        foreach ($request->file('images') as $image) {
            $image_path = $image->store($this->image_path, 'public');
            PostImage::create([
                'post_id' => $post->id,
                'image_path' => $image_path,
            ]);
        }

        $post->amenities()->attach($request->selected_amenities);

        return redirect()->route('admin.post.index')->with('success', 'Post '. $request->title .' created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::where('id', $id)->with(['category', 'images', 'amenities'])->first();
        $categories = Category::all();
        $amenities = Amenity::all();
        $statuses = PostStatus::cases();

        $statuses = collect($statuses)->map(function ($status) {
            return [
                'id' => $status->value,
                'name' => $status->name,
            ];
        });

        return Inertia::render('Owner/Post/PostForm', [
            'post' => $post,
            'categories' => $categories,
            'amenities' => $amenities,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
                \Illuminate\Validation\Rule::unique(Post::class)->ignore($id),
            ],
            'description' => 'required|string',
            'price' => 'required|integer|min:1000',
            'category_id' => 'required|exists:'.Category::class.',id',
            'quantity' => 'required|numeric|min:1',
            'status' => ['required', new Enum(PostStatus::class)],
            'selected_amenities' => 'required|array|min:1',
            'selected_amenities.*' => 'required|exists:'.Amenity::class.',id',
            'images' => 'required|array',
            'images.*' => ['nullable', function ($attribute, $value, $fail) {
                if ($value instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
                    if (!in_array($value->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                        $fail('Only image files are allowed.');
                    }
                }
            }],
        ], [
            'selected_amenities.required' => 'Please select at least one amenities.',
            'images.required' => 'Please upload at least one image.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post = Post::where('id', $id)->with(['category', 'images', 'amenities'])->first();

        $quantity_left = (($request->quantity - $post->quantity + $post->quantity_left) > -1) ? $request->quantity - $post->quantity + $post->quantity_left : 0;

        $post->update([
            'category_id' => $request->category_id,
            'title' => strtolower($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'quantity_left' => $quantity_left,
            'status' => $request->status,
        ]);

        // Delete images from database
        $oldImagePaths = $post->images->pluck('image_path')->toArray();
        $post->images()->delete();

        // Re-insert images
        $insertedPaths = [];
        if ($request->images) {
            foreach ($request->images as $index => $image) {
                // Check if the image is a string path (old image)
                if (is_string($image)) {
                    PostImage::create([
                        'post_id' => $post->id,
                        'image_path' => $image,
                    ]);
                    $insertedPaths[] = $image;
                }
                // New Uploaded Image
                elseif ($request->hasFile("images.$index")) {
                    $path = $request->file("images.$index")->store($this->image_path, 'public');
                    PostImage::create([
                        'post_id' => $post->id,
                        'image_path' => $path,
                    ]);
                    $insertedPaths[] = $path;
                }
            }
        }

        // Delete images from storage
        $unusedImages = array_diff($oldImagePaths, $insertedPaths);
        foreach ($unusedImages as $unused) {
            if (Storage::disk('public')->exists($unused)) {
                Storage::disk('public')->delete($unused);
            }
        }

        // Delete all existing amenities for the product first
        $post->amenities()->detach();

        // Insert new rules
        if ($request->selected_amenities) {
            $post->amenities()->attach($request->selected_amenities);
        }

        return redirect()->route('admin.post.index')->with('success', 'Post '. $request->title .' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::where('id', $id)->first();
        $imagePaths = $post->images->pluck('image_path')->toArray();
        $post->delete();
        foreach ($imagePaths as $path) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        return redirect()->route('admin.post.index')->with('success', 'Post '. $post->title .' deleted successfully');
    }
}
