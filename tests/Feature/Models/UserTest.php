<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Flight;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfUserModelCanBeCreated(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    public function test_CheckIfUserModelHasFillableAttributes(): void
    {
        $user = new User();

        $this->assertEquals(['name', 'email', 'password', 'role',], $user->getFillable());
    }

    public function test_CheckIfUserModelHasHiddenAttributes(): void
    {
        $user = new User();

        $this->assertEquals(['password', 'remember_token'], $user->getHidden());
    }

    public function test_CheckIfUserHasManyReservations(): void
    {
        $user = User::factory()->create();

        Reservation::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        $this->assertCount(3, $user->reservations);
        $this->assertInstanceOf(Reservation::class, $user->reservations->first());
    }
}
