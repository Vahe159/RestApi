<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_create_order()
    {
        $user = User::create([
            'phone' => '79999999999',
            'name' => 'Test User',
            'address' => 'Test Address',
            'password' => Hash::make('secret123'),
        ]);
        $product = Product::create([
            'name' => 'Steak',
            'description' => 'Best steak',
            'price' => 100,
            'category' => 'meat',
            'available' => true,
        ]);
        $token = base64_encode($user->phone . ':secret123');
        $response = $this->withHeaders([
            'Authorization' => 'Basic ' . $token,
        ])->postJson('/api/orders', [
            'user_id' => $user->id,
            'items' => [
                ['product_id' => $product->id, 'quantity' => 2]
            ],
        ]);
        $response->assertStatus(201);
        $json = $response->json('data');
        $this->assertIsArray($json);
        $this->assertArrayHasKey('order_id', $json);
        $this->assertArrayHasKey('status', $json);
        $this->assertArrayHasKey('total', $json);
        $this->assertArrayHasKey('comment', $json);
        $this->assertArrayHasKey('created_at', $json);
        $this->assertArrayHasKey('items', $json);
        $this->assertIsArray($json['items']);
        $this->assertArrayHasKey('product_id', $json['items'][0]);
        $this->assertArrayHasKey('quantity', $json['items'][0]);
        $this->assertArrayHasKey('price', $json['items'][0]);
        $this->assertArrayHasKey('product', $json['items'][0]);
    }
}
