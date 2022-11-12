<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    private int $requestsCount = 5;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_events_queue(): void
    {
        $availableEvents = [
            'register' => 'Регистрация',
            'update'   => 'Обновление',
            'delete'   => 'Удаление',
            'payment'  => 'Оплата',
            'refund'   => 'Возврат платежа',
            'support'  => 'Обращение в поддержку',
        ];
        for ($i = 0; $i <= $this->requestsCount; $i++)
        {
            $randEventKey = array_rand($availableEvents);
            $response = $this->postJson('/api/user/event/catch', [
                'userId' => User::inRandomOrder()->first()->id,
                'event'  => [
                    'xmlId' => $randEventKey,
                    'name'  => $availableEvents[$randEventKey],
                ],
            ]);

            $response->assertStatus(200)->assertJson([
                'received' => true,
            ]);
        }


    }
}
