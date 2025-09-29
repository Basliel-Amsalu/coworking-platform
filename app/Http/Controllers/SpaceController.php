<?php

namespace App\Http\Controllers;

use App\Data\SpaceData;
use App\Data\UserData;
use App\Models\Amenity;
use App\Models\Space;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spaces = SpaceData::collect(Space::with('manager')->paginate(10));
        return Response()->json($spaces);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated = SpaceData::validate($request);
        $space = $request->user()->spaces()->create($validated);
        if (!empty($validated['amenities'])) {
            foreach ($validated['amenities'] as $amenityData) {
                    $amenity = Amenity::firstOrCreate(['name' => $amenityData["name"]]);
                    $space->amenities()->syncWithoutDetaching([$amenity->id]);
                }
        }
        $space = SpaceData::from($space);
        return Response()->json($space, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $pid)
    {
        $space = Space::with(['manager', 'desks', 'meeting_rooms', 'amenities'])->where("pid",$pid)->first();
        $space = SpaceData::from($space);
        return Response()->json($space);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $pid)
    {
        $validated = SpaceData::validate($request);
        $space = Space::where('pid', $pid)->firstOrFail();
        if (!empty($validated['amenities'])) {
            foreach ($validated['amenities'] as $amenityData) {
                    $amenity = Amenity::firstOrCreate(['name' => $amenityData["name"]]);
                    $space->amenities()->syncWithoutDetaching([$amenity->id]);
                }
            $validated = collect($validated)->except('amenities')->toArray();
        }
        $space->update($validated);
        $space = SpaceData::from($space);
        return Response()->json($space);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $pid)
    {
        $space = Space::where('pid', $pid)->firstOrFail();
        $space->delete();
        return response()->json(null, 204);
    }
}
