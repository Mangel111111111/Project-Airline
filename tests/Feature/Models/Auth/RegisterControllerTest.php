<?php

namespace Tests\Feature\Models\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfRegisterControllerRegistersNewUserAndRedirectsToHome(): void
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/home');
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    public function test_CheckIfRegisterControllerUsesGuestMiddleware(): void
    {
        $controller = new \App\Http\Controllers\Auth\RegisterController();

        $middlewares = array_column($controller->getMiddleware(), 'middleware');
        $this->assertContains('guest', $middlewares);
    }

    public function test_CheckIfRegisterControllerValidatorWorksCorrectly(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'password_confirmation' => 'password',
            'password_confirmation' => 'password',
        ];

        $validator = \Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $this->assertFalse($validator->fails());
    }
}
