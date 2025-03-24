<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airplane;

class AirplaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airplanes = [
            [
                'model' => 'Boeing 747',
                'seatCapacity' => 416
            ],
            [
                'model' => 'Airbus A320',
                'seatCapacity' => 180
            ],
            [
                'model' => 'Embraer 190',
                'seatCapacity' => 100
            ],
            [
                'model' => 'Boeing 737',
                'seatCapacity' => 215
            ],
            [
                'model' => 'Airbus A380',
                'seatCapacity' => 853
            ],
            [
                'model' => 'Boeing 777',
                'seatCapacity' => 396
            ],
            [
                'model' => 'Airbus A330',
                'seatCapacity' => 335
            ],
            [
                'model' => 'Boeing 787',
                'seatCapacity' => 242
            ],
            [
                'model' => 'Airbus A350',
                'seatCapacity' => 440
            ],
            [
                'model' => 'Boeing 767',
                'seatCapacity' => 375
            ],
        ];

        foreach ($airplanes as $airplane) {
            Airplane::create($airplane);
        }
    }
}
