<?php

namespace App\Services;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\Storage;

class PostService
{
    private string $image_path = 'images/posts';

    public function create(StorePostRequest $request): void
    {
        $post = Post::create([
            'category_id' => $request->category_id,
            'title' => strtolower($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
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
    }

    public function update(UpdatePostRequest $request, Post $post): void
    {
        $post->load(['category', 'images', 'amenities']);

        $post->update([
            'category_id' => $request->category_id,
            'title' => strtolower($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
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

//        $post->amenities()->sync($request->selected_amenities ?? []);

        // Delete all existing amenities for the product first
        $post->amenities()->detach();

        // Insert new rules
        if ($request->selected_amenities) {
            $post->amenities()->attach($request->selected_amenities);
        }
    }

    public function delete(Post $post): void
    {
        $imagePaths = $post->images->pluck('image_path')->toArray();
        $post->delete();
        foreach ($imagePaths as $path) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
