<?php

namespace App\Http\Controllers\Api;

use App\Models\Airplane;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AirplaneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airplanes = Airplane::all();

        return response()->json($airplanes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'model' => 'required|string',
            'seatCapacity' => 'required|integer',
        ]);

        $airplane = Airplane::create($validatedData);

        return response()->json($airplane, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $airplanes = Airplane::find($id);

        return response()->json($airplanes, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $airplanes = Airplane::find($id);

        $validated = $request->validate([
            'model' => 'required|string',
            'seatCapacity' => 'required|integer'
        ]);

        $airplanes->update([
            'model' => $validated['model'],
            'seatCapacity' => $validated['seatCapacity']
        ]);

        $airplanes->save();

        return response()->json($airplanes, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $airplanes = Airplane::find($id);

        $airplanes->delete();

        return response()->json(['message' => 'Airplane deleted successfully'], 200);
    }
}
