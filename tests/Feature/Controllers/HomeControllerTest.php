<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfHomeControllerIndexReturnsHomeView(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function test_CheckIfHomeControllerUsesAuthMiddleware(): void
    {
        $controller = new HomeController();

        $this->assertContains('auth', array_column($controller->getMiddleware(), 'middleware'));
    }
}
