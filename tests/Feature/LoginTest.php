<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_login()
    {
        $user = User::create([
            'phone' => '79999999999',
            'name' => 'Test User',
            'address' => 'Test Address',
            'password' => Hash::make('secret123'),
        ]);
        $response = $this->postJson('/api/login', [
            'phone' => '79999999999',
            'password' => 'secret123',
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure(['message', 'token', 'user_id']);
    }
}
