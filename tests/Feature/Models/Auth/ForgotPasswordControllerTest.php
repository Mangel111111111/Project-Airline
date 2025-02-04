<?php

namespace Tests\Feature\Models\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfForgotPasswordControllerSendsPasswordResetEmail(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
        ]);

        $response = $this->post('/password/email', [
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status', trans(Password::RESET_LINK_SENT));
    }

    public function test_CheckIfForgotPasswordControllerUsesSendsPasswordResetEmailsTrait(): void
    {
        $controller = new ForgotPasswordController();

        $this->assertContains(SendsPasswordResetEmails::class, class_uses($controller));
    }
}
