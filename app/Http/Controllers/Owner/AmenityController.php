<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AmenityController extends Controller
{
    private $image_path = 'images/icons/amenity';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amenities = Amenity::latest('created_at')->paginate(10);

        return Inertia::render('Owner/Amenity/AmenityList', [
            'amenities' => $amenities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Owner/Amenity/AmenityForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255|unique:'.Amenity::class,
            'icon_path' => 'required|image|mimes:png|max:10240',
        ]);

        $iconLinkPath = $request->file('icon_path')->store($this->image_path, 'public');
        Amenity::create([
            'name' => strtolower($request->name),
            'icon_path' => $iconLinkPath,
        ]);

        return redirect()->route('admin.amenity.index')->with('success', 'Amenity '. $request->name .' created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.amenity.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $amenity = Amenity::where('id', $id)->first();

        return Inertia::render('Owner/Amenity/AmenityForm', [
            'amenity' => $amenity,
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
                Rule::unique(Amenity::class)->ignore($id),
            ],
            'icon_path' => 'nullable|image|mimes:png|max:10240',
        ]);

        $amenity = Amenity::where('id', $id)->first();

        if ($request->hasFile('icon_path')) {
            Storage::disk('public')->delete($amenity->icon_path);
            $iconLinkPath = $request->file('icon_path')->store($this->image_path, 'public');
        } else {
            $iconLinkPath = $amenity->icon_path;
        }

        $amenity->update([
            'name' => strtolower($request->name),
            'icon_path' => $iconLinkPath,
        ]);

        return redirect()->route('admin.amenity.index')->with('success', 'Amenity '. $request->name .' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $amenity = Amenity::where('id', $id)->first();
        Amenity::where('id', $id)->delete();
        Storage::disk('public')->delete($amenity->icon_path);
        return redirect()->route('admin.amenity.index')->with('success', 'Amenity '. $amenity->name .' deleted successfully');
    }
}
