<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfUserModelCanBeCreated()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    public function test_CheckIfUserModelHasFillableAttributes()
    {
        $user = new User();

        $this->assertEquals(['name', 'email', 'password', 'role'], $user->getFillable());
    }

    public function test_CheckIfUserModelHasHiddenAttributes()
    {
        $user = new User();

        $this->assertEquals(['password', 'remember_token'], $user->getHidden());
    }

    public function test_CheckIfUserModelHasCastAttributes()
    {
        $user = new User();

        $this->assertEquals([
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'id' => 'int',
        ], $user->getCasts());
    }
}
