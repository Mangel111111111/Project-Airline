<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Flight;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfReservationBelongsToUser(): void
    {
        $user = User::factory()->create();

        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $reservation->user);
        $this->assertEquals($user->id, $reservation->user->id);
    }

    public function test_CheckIfExceptionIsThrownWhenNoAvailableSeats(): void
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create([
            'seatCapacity' => 0,
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No available seats for this flight.');

        Reservation::factory()->create([
            'user_id' => $user->id,
            'flight_id' => $flight->id,
        ]);
    }
}
