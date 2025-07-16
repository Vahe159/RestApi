<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'phone' => '79999999999',
            'name' => 'Test User',
            'address' => 'Test Address',
            'password' => 'secret123',
        ]);
        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'user_id']);
    }
}
