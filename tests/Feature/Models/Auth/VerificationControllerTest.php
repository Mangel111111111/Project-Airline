<?php

namespace Tests\Feature\Models\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Auth\VerificationController;

class VerificationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfVerificationControllerVerifiesEmailAndRedirectsToHome(): void
    {
        Event::fake();

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect('/home');
        $this->assertNotNull($user->fresh()->email_verified_at);
        Event::assertDispatched(Verified::class);
    }

    public function test_CheckIfVerificationControllerUsesVerifiesEmailsTrait(): void
    {
        $controller = new VerificationController();

        $this->assertContains(VerifiesEmails::class, class_uses($controller));
    }

    public function test_CheckIfVerificationControllerUsesCorrectMiddlewares(): void
    {
        $controller = new VerificationController();

        $middlewares = array_column($controller->getMiddleware(), 'middleware');
        $this->assertContains('auth', $middlewares);
        $this->assertContains('signed', $middlewares);
        $this->assertContains('throttle:6,1', $middlewares);
    }
}
