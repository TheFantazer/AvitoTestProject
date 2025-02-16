<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_buy_product()
    {
        $user = User::factory()->create(['coins' => 1000]);
        $product = Product::factory()->create(['name' => 't-shirt', 'price' => 80]);

        // Генерируем токен для пользователя
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Передаем токен в заголовке
        ])->getJson('/api/buy/t-shirt');

        $response->assertStatus(200)
            ->assertJson(['message' => 'Product purchased successfully']);
    }
}
