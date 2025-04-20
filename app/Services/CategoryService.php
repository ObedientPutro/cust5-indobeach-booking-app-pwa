<?php

namespace App\Services;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    private string $image_path = 'images/icons/category';

    public function create(StoreCategoryRequest $request): void
    {
        $iconLinkPath = $request->file('icon_path')->store($this->image_path, 'public');

        Category::create([
            'name' => strtolower($request->name),
            'icon_path' => $iconLinkPath,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category): void
    {
        if ($request->hasFile('icon_path')) {
            Storage::disk('public')->delete($category->icon_path);
            $iconLinkPath = $request->file('icon_path')->store($this->image_path, 'public');
        } else {
            $iconLinkPath = $category->icon_path;
        }

        $category->update([
            'name' => strtolower($request->name),
            'icon_path' => $iconLinkPath,
        ]);
    }

    public function delete(Category $category): void
    {
        Category::where('id', $category->id)->delete();
        Storage::disk('public')->delete($category->icon_path);
    }

}
