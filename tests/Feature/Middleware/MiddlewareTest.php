<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_CheckIfRoleMiddlewareHandlesRequest(): void
    {
        $middleware = new RoleMiddleware();

        $request = Request::create('/test', 'GET');
        $next = function ($request) {
            return response('Next middleware called');
        };

        $response = $middleware->handle($request, $next);

        $this->assertEquals('Next middleware called', $response->getContent());
    }
}
