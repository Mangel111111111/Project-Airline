<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\Flight;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfcreatesAFlightCorrectly()
    {
        $flight = Flight::factory()->create([
            'origin' => 'New York',
            'destination' => 'Los Angeles',
            'departureTime' => '2025-03-15 08:00:00',
            'arrivalTime' => '2025-03-15 11:00:00',
            'availableSeats' => 150,
            'status' => 'active'
        ]);

        $this->assertDatabaseHas('flights', [
            'id' => $flight->id,
            'origin' => 'New York',
            'destination' => 'Los Angeles',
            'status' => 'active'
        ]);
    }

    public function test_CheckIfupdatesTheStatusCorrectly()
    {
        $flight = Flight::factory()->create(['availableSeats' => 0]);

        $flight->updateStatus();

        $this->assertEquals('inactive', $flight->status);
    }
}
