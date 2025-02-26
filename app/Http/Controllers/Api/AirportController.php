<?php

namespace App\Http\Controllers\Api;

use App\Models\Airport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airports = Airport::all();

        return response()->json($airports, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'    => 'required|string',
            'city'    => 'required|string',
            'country' => 'required|string'
        ]);

        $airport = Airport::create($validatedData);

        return response()->json($airport, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $airports = Airport::find($id);

        return response()->json($airports, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $airports = Airport::find($id);

        $validated = $request->validate([
            'name'    => 'required|string',
            'city'    => 'required|string',
            'country' => 'required|string'
        ]);

        $airports->update([
            'name' => $validated['name'],
            'city' => $validated['city'],
            'country' => $validated['country']
        ]);

        $airports->save();

        return response()->json($airports, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $airports = Airport::find($id);

        $airports->delete();

        return response()->json(['message' => 'Airport deleted successfully'], 200);
    }
}
