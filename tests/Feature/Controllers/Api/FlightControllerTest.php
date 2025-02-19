<?php

namespace Tests\Feature\Controllers\Api;

use Tests\TestCase;
use App\Models\Flight;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_CheckIfCanGetAllTheFlights() {

        Flight::factory()->count(3)->create();

        $response = $this->getJson('/api/flights');

        $response->assertStatus(200)
                 ->assertJsonStructure([['id', 'origin', 'destination']]);
    }

    public function test_CheckIfCanCreateAndFlight()
    {
        $airplane = Airplane::factory()->create();

        $response = $this->postJson('/api/flights', [
            'origin' => 'Miami',
            'destination' => 'New York',
            'departureTime' => '2025-03-10 08:00:00',
            'arrivalTime' => '2025-03-10 12:30:00',
            'airplane_id' => '1',
            'availableSeats' => '100'
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'origin', 'destination']);
    }

    public function test_CheckIfCanGetOneFlightById()
    {
        $flight = Flight::factory()->create();

        $response = $this->getJson("/api/flights/{$flight->id}");

        $response->assertStatus(200)
                 ->assertJson(['id' => $flight->id]);
    }

    public function test_CheckIfCanUpdateAnFlight()
    {
        $airplane = Airplane::factory()->create();
        $flight = Flight::factory()->create();

        $response = $this->putJson("/api/flights/{$flight->id}", [
            'origin' => 'Miami',
            'destination' => 'New York',
            'departureTime' => '2025-03-10 08:00:00',
            'arrivalTime' => '2025-03-10 11:30:00',
            'airplane_id' => '1',
            'availableSeats' => '120'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
            'origin' => 'Miami',
            'destination' => 'New York',
            'departureTime' => '2025-03-10 08:00:00',
            'arrivalTime' => '2025-03-10 11:30:00',
            'airplane_id' => '1',
            'availableSeats' => '120'
        ]);
    }

    public function test_CheckIfCanDeleteAnFlight()
    {
        $flight = Flight::factory()->create();

        $response = $this->deleteJson("/api/flights/{$flight->id}");

        $response->assertStatus(200);
    }
}
