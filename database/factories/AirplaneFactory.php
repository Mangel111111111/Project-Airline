<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airplane>
 */
class AirplaneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => $this->faker->randomElement(['Boeing 747', 'Airbus A320', 'Embraer 190']),
            'seatCapacity' => $this->faker->numberBetween(100, 400),
        ];
    }
}
