<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CategoryController extends Controller
{
    private $image_path = 'images/icons/category';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('created_at')->withCount(['posts'])->paginate(10);

        return Inertia::render('Owner/Category/CategoryList', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Owner/Category/CategoryForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255|unique:'.Category::class,
            'icon_path' => 'required|image|mimes:png|max:10240',
        ]);

        $iconLinkPath = $request->file('icon_path')->store($this->image_path, 'public');
        Category::create([
            'name' => strtolower($request->name),
            'icon_path' => $iconLinkPath,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category '. $request->name .' created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::where('id', $id)->first();

        return Inertia::render('Owner/Category/CategoryForm', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique(Category::class)->ignore($id),
            ],
            'icon_path' => 'nullable|image|mimes:png|max:10240',
        ]);

        $category = Category::where('id', $id)->first();

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

        return redirect()->route('admin.category.index')->with('success', 'Category '. $request->name .' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id', $id)->first();
        Category::where('id', $id)->delete();
        Storage::disk('public')->delete($category->icon_path);
        return redirect()->route('admin.category.index')->with('success', 'Category '. $category->name .' deleted successfully');
    }
}
