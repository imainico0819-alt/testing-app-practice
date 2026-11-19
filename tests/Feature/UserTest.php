<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_create_user(): void
    {
        User::factory()->create([
            'name' => 'test user',
            'email' => 'test@example.com'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'test user',
            'email' => 'test@example.com'
        ]);
    }

    public function test_email_must_be_unique(): void
    {
        User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create([
            'email' => 'test@example.com'
        ]);
    }
}
