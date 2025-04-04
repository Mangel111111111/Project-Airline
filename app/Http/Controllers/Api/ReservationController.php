<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'flight'])->get();

        return response()->json($reservations, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'flight_id' => 'required|exists:flights,id',
        ]);

        $flight = Flight::find($validated['flight_id']);

        if ($flight->availableSeats <= 0) {
            return response()->json(['error' => 'No available seats for this flight'], 400);
        }

        $reservation = Reservation::create($validated);

        return response()->json($reservation->load(['user', 'flight']), 201);
    }

    public function show(string $id)
    {
        $reservation = Reservation::with(['user', 'flight'])->find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        return response()->json($reservation, 200);
    }

    public function update(Request $request, string $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'flight_id' => 'sometimes|exists:flights,id',
        ]);

        $reservation->update($validated);

        return response()->json($reservation->load(['user', 'flight']), 200);
    }

    public function destroy(string $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted successfully'], 200);
    }
}