<?php

namespace App\Http\Controllers\Api;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flights = Flight::all();

        return response()->json($flights, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'departureTime' => 'required|date',
            'arrivalTime' => 'required|date|after:departureTime',
            'airplane_id' => 'required|exists:airplanes,id',
            'availableSeats' => 'required|integer|min:1',
        ]);

        $flight = Flight::create($validated);
        $flight->updateStatus();

        return response()->json($flight, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flight = Flight::find($id);

        return response()->json($flight, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $flight = Flight::find($id);

        $validated = $request->validate([
            'origin' => 'string',
            'destination' => 'string',
            'departureTime' => 'date',
            'arrivalTime' => 'date|after:departureTime',
            'airplane_id' => 'exists:airplanes,id',
            'availableSeats' => 'integer|min:1',
        ]);

        $flight->update($validated);
        $flight->updateStatus();

        return response()->json($flight, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flight = Flight::find($id);

        $flight->delete();

        return response()->json(['message' => 'Flight deleted successfully'], 200);
    }
}
