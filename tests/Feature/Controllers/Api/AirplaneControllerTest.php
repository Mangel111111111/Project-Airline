<?php

namespace Tests\Feature\Controllers\Api;

use Tests\TestCase;
use App\Models\Airplane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AirplaneControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_CheckIfCanGetAllTheAirplanes() {

        Airplane::factory()->count(3)->create();

        $response = $this->getJson('/api/airplane');

        $response->assertStatus(200)
                 ->assertJsonStructure([['id', 'model', 'seatCapacity']]);
    }

    public function test_CheckIfCanCreateAndAirplane()
    {
        $response = $this->postJson('/api/airplane', [
            'model' => 'Airbus A320',
            'seatCapacity' => 180
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'model', 'seatCapacity']);
    }

    public function test_CheckIfCanGetOneAirplaneById()
    {
        $airplane = Airplane::factory()->create();

        $response = $this->getJson("/api/airplane/{$airplane->id}");

        $response->assertStatus(200)
                 ->assertJson(['id' => $airplane->id]);
    }

    public function test_CheckIfCanUpdateAnAirplane()
    {
        $airplane = Airplane::factory()->create();

        $response = $this->putJson("/api/airplane/{$airplane->id}", [
            'model' => 'Boeing 747',
            'seatCapacity' => 300
        ]);

        $response->assertStatus(200)
                 ->assertJson(['model' => 'Boeing 747']);
    }

    public function test_CheckIfCanDeleteAnAirplane()
    {
        $airplane = Airplane::factory()->create();

        $response = $this->deleteJson("/api/airplane/{$airplane->id}");

        $response->assertStatus(200);
    }
}
