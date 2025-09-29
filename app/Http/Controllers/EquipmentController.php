<?php

namespace App\Http\Controllers;

use App\Data\EquipmentData;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = Equipment::with('meeting_rooms')->paginate(10);
        $equipments = EquipmentData::collect($equipments);
        return Response()->json($equipments, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = EquipmentData::validate($request);
        $equipment = Equipment::create($validated);
        $equipment = EquipmentData::from($equipment);
        return Response()->json($equipment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $pid)
    {
        $equipment = EquipmentData::from(Equipment::where('pid',$pid)->with('meeting_rooms')->firstOrFail());
        return Response()->json($equipment, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = EquipmentData::validate($request);
        $equipment = Equipment::where('pid', $id)->firstOrFail();
        $equipment->update($validated);
        $equipment = EquipmentData::from($equipment);
        return Response()->json($equipment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipment = Equipment::where('pid', $id)->firstOrFail();
        $equipment->delete();
        return Response()->noContent();
    }
}
