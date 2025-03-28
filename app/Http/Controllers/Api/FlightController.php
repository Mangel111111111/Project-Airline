<?php

namespace App\Http\Controllers\Api;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::with(['originAirport', 'destinationAirport', 'airplane'])->get();
        return response()->json($flights, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origin_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id',
            'departureTime' => 'required|date',
            'arrivalTime' => 'required|date|after:departureTime',
            'airplane_id' => 'required|exists:airplanes,id',
            'seatCapacity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $flight = Flight::create($validated);
        return response()->json($flight, 201);
    }

    public function show($id)
    {
        $flight = Flight::with(['originAirport', 'destinationAirport', 'airplane'])->find($id);

        if (!$flight) {
            return response()->json(['error' => 'Flight not found'], 404);
        }

        return response()->json($flight, 200);
    }

    public function update(Request $request, $id)
    {
        $flight = Flight::find($id);

        if (!$flight) {
            return response()->json(['error' => 'Flight not found'], 404);
        }

        $validated = $request->validate([
            'origin_airport_id' => 'sometimes|exists:airports,id',
            'destination_airport_id' => 'sometimes|exists:airports,id',
            'departureTime' => 'sometimes|date',
            'arrivalTime' => 'sometimes|date|after:departureTime',
            'airplane_id' => 'sometimes|exists:airplanes,id',
            'seatCapacity' => 'sometimes|integer|min:1',
            'status' => 'sometimes|in:active,inactive',
        ]);

        $flight->update([
            'origin_airport_id' => $validated['origin_airport_id'],
            'destination_airport_id' => $validated['destination_airport_id'],
            'departureTime' => $validated['departureTime'],
            'arrivalTime' => $validated['arrivalTime'],
            'airplane_id' => $validated['airplane_id'],
            'seatCapacity' => $validated['seatCapacity'],
            'status' => $validated['status'],
        ]);

        $flight->save();

        return response()->json($flight, 200);
    }

    public function destroy($id)
    {
        $flight = Flight::find($id);

        if (!$flight) {
            return response()->json(['error' => 'Flight not found'], 404);
        }

        $flight->delete();
        return response()->json(['message' => 'Flight deleted successfully'], 200);
    }
}
