<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CoinTransferTest extends TestCase
{
    use RefreshDatabase;
    public function test_coin_transfer()
    {
        // Регистрация и авторизация пользователя
        $this->postJson('/api/auth/register', [
            'name' => 'Sender',
            'email' => 'sender@example.com',
            'password' => 'password',
        ]);

        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => 'sender@example.com',
            'password' => 'password',
        ]);

        $token = $loginResponse->json('token');

        // Передача монеток
        $transferResponse = $this->postJson('/api/coins/transfer', [
            'to_user_id' => 2,
            'amount' => 100,
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $transferResponse->assertStatus(200)
            ->assertJson(['message' => 'Coins transferred successfully']);
    }
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
