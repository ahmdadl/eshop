<?php

namespace Tests\Unit;

use App\Order;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testIHaveOrders()
    {
        $user = factory(User::class)->create();

        $this->assertIsIterable($user->orders);

        $order = $user->orders()->save(
            factory(Order::class)->make()
        );

        $user->load('orders');

        $this->assertCount(1, $user->orders);
    }
}
