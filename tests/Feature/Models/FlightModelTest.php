<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\Flight;
use App\Models\Airplane;
use App\Models\Reservation;
use App\Models\Airport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCreatesAFlightCorrectly()
    {
        $originAirport = Airport::factory()->create();
        $destinationAirport = Airport::factory()->create();
        $airplane = Airplane::factory()->create();

        $flight = Flight::factory()->create([
            'origin_airport_id' => $originAirport->id,
            'destination_airport_id' => $destinationAirport->id,
            'departureTime' => '2025-03-15 08:00:00',
            'arrivalTime' => '2025-03-15 11:00:00',
            'seatCapacity' => 150,
            'status' => 'active',
            'airplane_id' => $airplane->id,
        ]);

        $this->assertDatabaseHas('flights', [
            'id' => $flight->id,
            'origin_airport_id' => $originAirport->id,
            'destination_airport_id' => $destinationAirport->id,
            'status' => 'active',
        ]);
    }

    public function test_CheckIfUpdatesTheStatusCorrectly()
    {
        $flight = Flight::factory()->create([
            'seatCapacity' => 100,
            'departureTime' => now()->addHours(2),
        ]);

        $flight->updateStatus();
        $this->assertEquals('active', $flight->status);

        $flight->departureTime = now()->subHour();
        $flight->updateStatus();
        $this->assertEquals('inactive', $flight->status);
    }

    public function test_CheckIfFlightModelHasRelationshipWithAirplane()
    {
        $airplane = Airplane::factory()->create();
        $flight = Flight::factory()->create([
            'airplane_id' => $airplane->id,
        ]);

        $this->assertInstanceOf(Airplane::class, $flight->airplane);
    }

    public function test_CheckIfFlightModelHasRelationshipWithAirports()
    {
        $originAirport = Airport::factory()->create();
        $destinationAirport = Airport::factory()->create();

        $flight = Flight::factory()->create([
            'origin_airport_id' => $originAirport->id,
            'destination_airport_id' => $destinationAirport->id,
        ]);

        $this->assertEquals($originAirport->id, $flight->originAirport->id);
        $this->assertEquals($destinationAirport->id, $flight->destinationAirport->id);
    }

    public function test_CheckIfAvailableSeatsAreCalculatedCorrectly()
    {
        $flight = Flight::factory()->create(['seatCapacity' => 100]);

        Reservation::factory()->count(10)->create(['flight_id' => $flight->id]);

        $this->assertEquals(90, $flight->availableSeats);
    }

    /* public function test_CheckIfFlightHasManyUsersThroughReservations(): void
    {
        $flight = Flight::factory()->create();
        $users = User::factory()->count(3)->create();

        foreach ($users as $user) {
            Reservation::factory()->create([
                'flight_id' => $flight->id,
                'user_id' => $user->id,
            ]);
        }

        $this->assertCount(3, $flight->users);
        $this->assertInstanceOf(User::class, $flight->users->first());
    } */
}
