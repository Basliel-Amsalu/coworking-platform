<?php

namespace App\Http\Controllers;

use App\Data\AmenityData;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amenities = Amenity::with('spaces')->paginate(10);
        return Response()->json($amenities, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = AmenityData::validate($request);
        $amenity = Amenity::create($validated);
        $amenity = AmenityData::from($amenity);
        return Response()->json($amenity, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $pid)
    {
        $amenity = AmenityData::from(Amenity::where('pid',$pid)->with('spaces')->firstOrFail());
        return Response()->json($amenity, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $pid)
    {
        $validated = AmenityData::validate($request);
        $amenity = Amenity::where('pid', $pid)->firstOrFail();
        $amenity->update($validated);
        $amenity = AmenityData::from($amenity);
        return Response()->json($amenity, 200);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $pid)
    {
        $amenity = Amenity::where('pid', $pid)->firstOrFail();
        $amenity->delete();
        return Response()->noContent();
    }
}
