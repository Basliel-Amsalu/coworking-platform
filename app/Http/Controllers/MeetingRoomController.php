<?php

namespace App\Http\Controllers;

use App\Data\MeetingRoomData;
use App\Models\Equipment;
use App\Models\MeetingRoom;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MeetingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = MeetingRoom::with('equipment')->paginate(10);
        return Response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = MeetingRoomData::validate($request);
        $room = null;
        if($validated["space_pid"]){
            $space = Space::where('pid', $validated['space_pid'])->firstOrFail();
            unset($validated['space_pid']);
            $validatedWithoutEquipment = collect($validated)->except('equipment')->toArray();
            $room = $space->meeting_rooms()->create($validatedWithoutEquipment);
        }else{
            $validatedWithoutEquipment = collect($validated)->except('equipment')->toArray();
            $room = MeetingRoom::create($validatedWithoutEquipment);
        }
         if (!empty($validated['equipment'])) {
            foreach ($validated['equipment'] as $equipmentData) {
                    $equipment = Equipment::firstOrCreate(['name' => $equipmentData["name"]]);
                    $room->equipment()->syncWithoutDetaching([$equipment->id]);
                }
        }
        $room = MeetingRoomData::from($room);
        return Response()->json($room, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $pid)
    {
        $room = MeetingRoomData::from(MeetingRoom::with('equipment')->where('pid', $pid)->firstOrFail());
        return Response()->json($room, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $pid)
    {
        $validated = MeetingRoomData::validate($request);
        $room = MeetingRoom::where('pid', $pid)->firstOrFail();
        if (!empty($validated['equipment'])) {
            foreach ($validated['equipment'] as $equipmentData) {
                    $equipment = Equipment::firstOrCreate(['name' => $equipmentData["name"]]);
                    $room->equipment()->syncWithoutDetaching([$equipment->id]);
                }
            $validated = collect($validated)->except('equipment')->toArray();
        }
        $room->update($validated);
        $room = MeetingRoomData::from($room);
        return Response()->json($room, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $pid)
    {
        $room = MeetingRoom::where('pid', $pid)->firstOrFail();
        $room->delete();
        return Response()->noContent();
    }
}
