<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class CoinTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_coin()
    {
        $fromUser = User::factory()->create(['coins' => 1000]);
        $toUser = User::factory()->create(['coins' => 1000]);

        // Генерируем токен для пользователя
        $token = JWTAuth::fromUser($fromUser);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Передаем токен в заголовке
        ])->postJson('/api/sendCoin', [
            'toUser' => $toUser->id,
            'amount' => 100,
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Coins sent successfully']);
    }
}
