<?php

namespace Tests\Feature\Controllers\Api;

use Tests\TestCase;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCanListFlights()
    {
        Flight::factory()->count(3)->create();

        $response = $this->getJson('/api/flights');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_CheckIfCanCreateAFlight()
    {
        $originAirport = Airport::factory()->create();
        $destinationAirport = Airport::factory()->create();
        $airplane = Airplane::factory()->create();

        $data = [
            'origin_airport_id' => $originAirport->id,
            'destination_airport_id' => $destinationAirport->id,
            'departureTime' => now()->addHours(5)->toDateTimeString(),
            'arrivalTime' => now()->addHours(8)->toDateTimeString(),
            'airplane_id' => $airplane->id,
            'seatCapacity' => 150,
            'status' => 'active',
        ];

        $response = $this->postJson('/api/flights', $data);

        $response->assertStatus(201);
        $response->assertJsonFragment($data);
    }

    public function test_CheckIfCanUpdateAFlight()
    {
        $flight = Flight::factory()->create([
            'seatCapacity' => 100,
            'status' => 'active',
        ]);

        $data = [
            'seatCapacity' => 120,
            'status' => 'inactive',
        ];

        $response = $this->putJson("/api/flights/{$flight->id}", $data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
        $this->assertDatabaseHas('flights', $data);
    }

    public function test_CheckIfCanDeleteAFlight()
    {
        $flight = Flight::factory()->create();

        $response = $this->deleteJson("/api/flights/{$flight->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
    }

    public function test_CheckIfCannotUpdateNonexistentFlight()
    {
        $response = $this->putJson('/api/flights/999', [
            'seatCapacity' => 120,
        ]);

        $response->assertStatus(404);
        $response->assertJson(['error' => 'Flight not found']);
    }

    public function test_CheckIfCannotDeleteNonexistentFlight()
    {
        $response = $this->deleteJson('/api/flights/999');

        $response->assertStatus(404);
        $response->assertJson(['error' => 'Flight not found']);
    }
}
