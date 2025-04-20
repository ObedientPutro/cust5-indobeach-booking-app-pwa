<?php

namespace App\Services;

use App\Http\Requests\Amenity\StoreAmenityRequest;
use App\Http\Requests\Amenity\UpdateAmenityRequest;
use App\Models\Amenity;
use Illuminate\Support\Facades\Storage;

class AmenityService
{
    private string $image_path = 'images/icons/amenity';

    public function create(StoreAmenityRequest $request): void
    {
        $iconLinkPath = $request->file('icon_path')->store($this->image_path, 'public');

        Amenity::create([
            'name' => strtolower($request->name),
            'icon_path' => $iconLinkPath,
        ]);
    }

    public function update(UpdateAmenityRequest $request, Amenity $amenity): void
    {
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
    }

    public function delete(Amenity $amenity): void
    {
        Amenity::where('id', $amenity->id)->delete();
        Storage::disk('public')->delete($amenity->icon_path);
    }

}
