<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_user_can_be_created()
    {
        $user = User::factory()->create([
            'name' => 'test user',
            'email' => 'test@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'test user',
            'email' => 'test@example.com',
        ]);
    }

    public function test_email_must_be_unique()
    {
        User::factory()->create([
            'email' => 'duplicate@example.com',
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create([
            'email' => 'duplicate@example.com',
        ]);
    }
}
