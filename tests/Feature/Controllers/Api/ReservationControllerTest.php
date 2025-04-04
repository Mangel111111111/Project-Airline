<?php

namespace Tests\Feature\Controllers\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Airplane;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationControllerTest extends TestCase
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
        $originAirport = Airport::factory()->create();
        $destinationAirport = Airport::factory()->create();
        $airplane = Airplane::factory()->create();

        $flight = Flight::factory()->create([
            'origin_airport_id' => $originAirport->id,
            'destination_airport_id' => $destinationAirport->id,
            'departureTime' => now()->addHours(5)->toDateTimeString(),
            'arrivalTime' => now()->addHours(8)->toDateTimeString(),
            'airplane_id' => $airplane->id,
            'seatCapacity' => 150,
            'status' => 'active',
        ]);

        $data = [
            'origin_airport_id' => $originAirport->id,
            'destination_airport_id' => $destinationAirport->id,
            'departureTime' => now()->addHours(5)->toDateTimeString(),
            'arrivalTime' => now()->addHours(8)->toDateTimeString(),
            'airplane_id' => $airplane->id,
            'seatCapacity' => 250,
            'status' => 'inactive',
        ];

        $response = $this->putJson("/api/flights/{$flight->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('flights', [
            'id' => $flight->id,
            'seatCapacity' => 250,
            'status' => 'inactive',
        ]);
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

    public function test_CheckIfCanListReservations()
    {
        Reservation::factory()->count(3)->create();

        $response = $this->getJson('/api/reservations');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_CheckIfCanCreateAReservation()
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create();

        $data = [
            'user_id' => $user->id,
            'flight_id' => $flight->id,
        ];

        $response = $this->postJson('/api/reservations', $data);

        $response->assertStatus(201);
        $response->assertJsonFragment($data);
        $this->assertDatabaseHas('reservations', $data);
    }

    public function test_CheckIfCanUpdateAReservation()
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create();

        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'flight_id' => $flight->id,
        ]);

        $newFlight = Flight::factory()->create();

        $data = [
            'flight_id' => $newFlight->id,
        ];

        $response = $this->putJson("/api/reservations/{$reservation->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('reservations', [
            'id' => $reservation->id,
            'flight_id' => $newFlight->id,
        ]);
    }

    public function test_CheckIfCanDeleteAReservation()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->deleteJson("/api/reservations/{$reservation->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('reservations', ['id' => $reservation->id]);
    }

    public function test_CheckIfCannotUpdateNonexistentReservation()
    {
        $response = $this->putJson('/api/reservations/999', [
            'flight_id' => 1,
        ]);

        $response->assertStatus(404);
        $response->assertJson(['error' => 'Reservation not found']);
    }

    public function test_CheckIfCannotDeleteNonexistentReservation()
    {
        $response = $this->deleteJson('/api/reservations/999');

        $response->assertStatus(404);
        $response->assertJson(['error' => 'Reservation not found']);
    }

    public function test_CheckIfCanGetOneReservationById(): void
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create();

        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'flight_id' => $flight->id,
        ]);

        $response = $this->getJson("/api/reservations/{$reservation->id}");

        $response->assertStatus(200)
                 ->assertJson(['id' => $reservation->id]);
    }
}
