<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
     /** @test */
    public function user_with_valid_credentials()
    {
        $user = User::factory()->create([
            'username' => 'agent2',
            'password' => bcrypt('agent2'),
        ]);

        $response = $this->postJson('/api/auth', [
            'username' => 'agent2',
            'password' => 'agent2'
        ]);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => ['token', 'minutes_to_expire']
        ]);
    }

    /** @test */
    public function user_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'username' => 'agent2',
            'password' => bcrypt('agent2'),
        ]);

        $response = $this->postJson('/api/auth', [
            'username' => 'agent2',
            'password' => 'agent22'
        ]);

        $response->assertStatus(401)
        ->assertJsonStructure([
            'meta' => ['success', 'errors']
        ]);
    }
}
