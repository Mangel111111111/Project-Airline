<?php

namespace Tests\Feature\Models\Auth;

use Hash;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Auth\ResetPasswordController;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfResetPasswordControllerResetsPasswordAndRedirectsToHome(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('oldpassword'),
        ]);

        $token = Password::createToken($user);

        $response = $this->post('/password/reset', [
            'email' => 'john@example.com',
            'token' => $token,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertRedirect('/home');
        $this->assertTrue(Hash::check('newpassword', $user->fresh()->password));
    }

    public function test_CheckIfResetPasswordControllerUsesResetsPasswordsTrait(): void
    {
        $controller = new ResetPasswordController();

        $this->assertContains(ResetsPasswords::class, class_uses($controller));
    }
}
