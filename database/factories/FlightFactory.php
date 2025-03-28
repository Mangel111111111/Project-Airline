<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\Airport;
use App\Models\Airplane;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        return [
            'origin_airport_id' => Airport::factory(),
            'destination_airport_id' => Airport::factory(),
            'departureTime' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'arrivalTime' => $this->faker->dateTimeBetween('+2 weeks', '+3 weeks'),
            'airplane_id' => Airplane::factory(),
            'seatCapacity' => $this->faker->numberBetween(50, 200),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
