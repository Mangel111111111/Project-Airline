<?php

namespace Tests\Feature\Models;

use App\Models\Airplane;
use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AirplaneModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfAirplaneHasManyFlights(): void
    {
        $airplane = Airplane::factory()->create();

        Flight::factory()->count(3)->create([
            'airplane_id' => $airplane->id,
        ]);

        $this->assertCount(3, $airplane->flights);
        $this->assertInstanceOf(Flight::class, $airplane->flights->first());
    }
}
