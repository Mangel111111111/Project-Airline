<?php

namespace Tests\Feature\Models;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AirportModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfAirportHasManyDepartingFlights(): void
    {
        $airport = Airport::factory()->create();

        Flight::factory()->count(3)->create([
            'origin_airport_id' => $airport->id,
        ]);

        $this->assertCount(3, $airport->departingFlights);
        $this->assertInstanceOf(Flight::class, $airport->departingFlights->first());
    }

    public function test_CheckIfAirportHasManyArrivingFlights(): void
    {
        $airport = Airport::factory()->create();

        Flight::factory()->count(3)->create([
            'destination_airport_id' => $airport->id,
        ]);

        $this->assertCount(3, $airport->arrivingFlights);
        $this->assertInstanceOf(Flight::class, $airport->arrivingFlights->first());
    }
}
