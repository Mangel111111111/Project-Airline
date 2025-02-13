<?php

namespace Database\Factories;

use App\Models\Airplane;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'origin' => $this->faker->city(),
            'destination' => $this->faker->city(),
            'departureTime' => $this->faker->dateTimeBetween('now', '+1 month'),
            'arrivalTime' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'airplane_id' => Airplane::factory(),
            'availableSeats' => $this->faker->numberBetween(50, 300),
        ];
    }
}
