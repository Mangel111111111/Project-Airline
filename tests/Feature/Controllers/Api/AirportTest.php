<?php

namespace Tests\Feature\Controllers\Api;

use Tests\TestCase;
use App\Models\Airport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AirportTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_CheckIfCanGetAllTheairports() {

        Airport::factory()->count(3)->create();

        $response = $this->getJson('/api/airports');

        $response->assertStatus(200)
                 ->assertJsonStructure([['id', 'name', 'city', 'country']]);
    }

    public function test_CheckIfCanCreateAndAirports()
    {
        $response = $this->postJson('/api/airports', [
            "name" => "Aeropuerto de la Pampa",
            "city" => "La Pampa",
            "country" => "Argentina"
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'name', 'city', 'country']);
    }

    public function test_CheckIfCanGetOneAirportsById()
    {
        $airports = Airport::factory()->create();

        $response = $this->getJson("/api/airports/{$airports->id}");

        $response->assertStatus(200)
                 ->assertJson(['id' => $airports->id]);
    }

    public function test_CheckIfCanUpdateAnAirports()
    {
        $airports = Airport::factory()->create();

        $response = $this->putJson("/api/airports/{$airports->id}", [
            "name" => "Aeropuerto de la Pampa",
            "city" => "La Pampa",
            "country" => "Argentina"
        ]);

        $response->assertStatus(200)
                 ->assertJson(["name" => "Aeropuerto de la Pampa"]);
    }

    public function test_CheckIfCanDeleteAnAirports()
    {
        $airports = Airport::factory()->create();

        $response = $this->deleteJson("/api/airports/{$airports->id}");

        $response->assertStatus(200);
    }
}
