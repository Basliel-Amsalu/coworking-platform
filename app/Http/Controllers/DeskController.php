<?php

namespace App\Http\Controllers;

use App\Data\DeskData;
use App\Models\Desk;
use App\Models\Space;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $desks = DeskData::collect(Desk::paginate(10));
        return Response()->json($desks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = DeskData::validate($request);
        if($validated["space_pid"]){
            $space = Space::where('pid', $validated['space_pid'])->firstOrFail();
            unset($validated['space_pid']);
            $desk = $space->desks()->create($validated);
            $desk = DeskData::from($desk);
            return Response()->json($desk, 201);
        }
        $desk = Desk::create($validated);
        $desk = DeskData::from($desk);
        return Response()->json($desk, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $pid)
    {
        $desk = DeskData::from(Desk::where('pid', $pid)->firstOrFail());
        return Response()->json($desk, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $pid)
    {
        $validated = DeskData::validate($request);
        $desk = Desk::where('pid', $pid)->firstOrFail();
        $desk->update($validated);
        $desk = DeskData::from($desk);
        return Response()->json($desk, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $pid)
    {
        $desk = Desk::where('pid', $pid)->firstOrFail();
        $desk->delete();
        return Response()->noContent();
    }
}
