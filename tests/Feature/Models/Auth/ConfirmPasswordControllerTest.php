<?php

namespace Tests\Feature\Models\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Auth\ConfirmPasswordController;

class ConfirmPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfConfirmPasswordControllerRedirectsToHome(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/password/confirm', [
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');
    }

    public function test_CheckIfConfirmPasswordControllerUsesAuthMiddleware(): void
    {
        $controller = new ConfirmPasswordController();

        $this->assertContains('auth', array_column($controller->getMiddleware(), 'middleware'));
    }
}
