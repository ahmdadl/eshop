<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testAnyOneCanAddToCart()
    {
        $this->withoutExceptionHandling();
        $p = factory(Product::class)->create();

        $cart = [
            'id' => $p->id,
            'product' => $p,
            'amount' => 2,
            'total' => 26
        ];

        $this->post('/api/cart', $cart)->assertOk()
            ->assertJsonPath('amount', 2)
            ->assertSessionHas('cart', [$cart]);

        $p = factory(Product::class)->create();

        $cart2 = [
            'id' => $p->id,
            'product' => $p,
            'amount' => 30,
            'total' => 26
        ];

        $this->post('/api/cart', $cart2)->assertOk()
            ->assertJsonPath('amount', 30)
            ->assertSessionHas('cart', [$cart, $cart2]);
    }

    public function testAnyOneCanNotAddTheSameProductTwice()
    {
        $cart = $this->createCart();

        /** @var \App\Product $p */
        $p = $cart['product'];

        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertSessionHas('cart', [$cart]);

        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertExactJson([
                'exists' => true
            ]);
    }

    private function createCart(
        ?object $product = null,
        ?int $amount = null,
        ?float $total = null
    ): array {
        $product = $product ?? factory(Product::class)->create();
        return [
            'id' => $product->id,
            'product' => $product,
            'amount' => $amount ?? $this->faker->randomDigit,
            'total' => $total ?? $this->faker->randomFloat(1, 0, 10000)
        ];
    }
}
