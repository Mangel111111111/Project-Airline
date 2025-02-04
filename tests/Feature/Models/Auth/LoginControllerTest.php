<?php

namespace Tests\Feature\Models\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfLoginControllerRedirectsToHomeAfterLogin(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_CheckIfLoginControllerUsesGuestMiddlewareExceptLogout(): void
    {
        $controller = new LoginController();

        $middlewares = array_column($controller->getMiddleware(), 'middleware');
        $this->assertContains('guest', $middlewares);
        $this->assertContains('auth', $middlewares);
    }
}
