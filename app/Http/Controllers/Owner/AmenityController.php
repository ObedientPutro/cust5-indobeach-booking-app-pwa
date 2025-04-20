<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Amenity\StoreAmenityRequest;
use App\Http\Requests\Amenity\UpdateAmenityRequest;
use App\Models\Amenity;
use App\Services\AmenityService;
use Inertia\Inertia;

class AmenityController extends Controller
{
    public function __construct(
        protected AmenityService $amenityService
    ) {}

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
    public function store(StoreAmenityRequest $request)
    {
        $this->amenityService->create($request);

        return redirect()->route('admin.amenity.index')->with('success', 'Amenity '. $request->name .' created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return redirect()->route('admin.amenity.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Amenity $amenity)
    {
        return Inertia::render('Owner/Amenity/AmenityForm', [
            'amenity' => $amenity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        $this->amenityService->update($request, $amenity);

        return redirect()->route('admin.amenity.index')->with('success', 'Amenity '. $request->name .' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amenity $amenity)
    {
        $this->amenityService->delete($amenity);

        return redirect()->route('admin.amenity.index')->with('success', 'Amenity '. $amenity->name .' deleted successfully');
    }
}
