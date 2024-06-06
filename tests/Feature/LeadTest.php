<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Models\Lead;


class LeadTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    protected function authenticate($user)
    {
        $token = JWTAuth::fromUser($user);
        return ['Authorization' => "Bearer $token"];
    }

    /** @test */
    public function manager_can_create_a_lead()
    {
        $user = User::factory()->create(['role' => 'manager']);
        $headers = $this->authenticate($user);

        $response = $this->postJson('/api/lead', [
            'name' => 'Mi candidato',
            'source' => 'Fotocasa',
            'owner' => $user->id
        ], $headers);

        $response->assertStatus(201)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => ['id', 'name', 'source', 'owner', 'created_at', 'created_by']
        ]);
    }

    /** @test */
    public function agent_cannot_create_a_lead()
    {
        $user = User::factory()->create(['role' => 'agent']);
        $headers = $this->authenticate($user);

        $response = $this->postJson('/api/lead', [
            'name' => 'Mi candidato',
            'source' => 'Fotocasa',
            'owner' => $user->id
        ], $headers);

        $response->assertStatus(401)
        ->assertJsonStructure([
            'meta' => ['success', 'errors']
        ]);
    }

    /** @test */
    public function user_can_view_a_lead()
    {
        $user = User::factory()->create();
        $headers = $this->authenticate($user);

        $lead = Lead::factory()->create([
            'name' => 'Mi candidato',
            'source' => 'Fotocasa',
            'owner' => $user->id,
            'created_by' => $user->id
        ]);

        $response = $this->getJson("/api/lead/{$lead->id}", $headers);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => ['id', 'name', 'source', 'owner', 'created_at', 'created_by']
        ]);
    }

    /** @test */
    public function user_can_view_all_leads()
    {
        $user = User::factory()->create(['role' => 'manager']);
        $headers = $this->authenticate($user);

        $lead1 = Lead::factory()->create(['owner' => $user->id, 'created_by' => $user->id]);
        $lead2 = Lead::factory()->create(['owner' => $user->id, 'created_by' => $user->id]);

        $response = $this->getJson('/api/leads', $headers);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'meta' => ['success', 'errors'],
            'data' => [
                '*' => ['id', 'name', 'source', 'owner', 'created_at', 'created_by']
            ]
        ]);
    }
}
