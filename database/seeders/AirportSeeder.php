<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airports = [
            [
                'name' => 'John F. Kennedy International Airport',
                'city' => 'New York',
                'country' => 'USA'
            ],
            [
                'name' => 'Los Angeles International Airport',
                'city' => 'Los Angeles',
                'country' => 'USA'
            ],
            [
                'name' => 'O\'Hare International Airport',
                'city' => 'Chicago',
                'country' => 'USA'
            ],
            [
                'name' => 'San Francisco International Airport',
                'city' => 'San Francisco',
                'country' => 'USA'
            ],
            [
                'name' => 'Miami International Airport',
                'city' => 'Miami',
                'country' => 'USA'
            ],
            [
                'name' => 'Dallas/Fort Worth International Airport',
                'city' => 'Dallas',
                'country' => 'USA'
            ],
            [
                'name' => 'Seattle-Tacoma International Airport',
                'city' => 'Seattle',
                'country' => 'USA'
            ],
            [
                'name' => 'Logan International Airport',
                'city' => 'Boston',
                'country' => 'USA'
            ],
            [
                'name' => 'George Bush Intercontinental Airport',
                'city' => 'Houston',
                'country' => 'USA'
            ],
            [
                'name' => 'Denver International Airport',
                'city' => 'Denver',
                'country' => 'USA'
            ],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}
