<?php

namespace Tests\Unit;

use App\Order;
use App\Product;
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

    public function testUserHasProducts()
    {
        $user = factory(User::class)->create();

        $this->assertIsIterable($user->products);

        $product = $user->products()->save(
            factory(Product::class)->make()
        );

        $user->load('products');

        $this->assertCount(1, $user->products);
    }

    public function testItCanBeAdmin()
    {
        $user = factory(User::class)->create();

        $this->assertTrue($user->isAdmin());
    }
}
