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

    public function testCartAmountCanBeUpdated()
    {
        $cart = $this->createCart(null, 5);

        /** @var \App\Product $p */
        $p = $cart['product'];

        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertSessionHas('cart', [$cart]);

        $cart['amount'] = 25;

        $this->patch('/api/cart/' . $p->id, ['amount' => 25])
            ->assertOk()
            ->assertSessionHas('cart', [$cart])
            ->assertExactJson(['updated' => true]);
    }

    public function testUpdatingCartRequiresItemExists()
    {
        $this->patch('/api/cart/55', [])
            ->assertOk()
            ->assertExactJson(['empty' => true]);

        $cart = $this->createCart();
        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertSessionHas('cart', [$cart]);

        $this->patch('/api/cart/445')
            ->assertOk()
            ->assertExactJson(['exists' => false]);
    }

    public function testCartCanBeDeleted()
    {
        $cart = $this->createCart();
        $cats2 = $this->createCart();

        $id = $cart['id'];

        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertSessionHas('cart', [$cart]);

        $this->post('/api/cart', $cats2)
            ->assertOk()
            ->assertSessionHas('cart', [$cart, $cats2]);

        $this->delete('/api/cart/' . $id)
            ->assertOk()
            ->assertSessionHas('cart', [$cats2])
            ->assertExactJson([
                'deleted' => true
            ]);
    }

    public function testRemovingAnItemFromCartErrors()
    {

        // trying to remove while cart is empty
        $this->delete('/api/cart/55')
            ->assertOk()
            ->assertExactJson(['empty' => true]);

        // remove cart with invalid id
        $cart = $this->createCart();
        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertSessionHas('cart', [$cart]);

        $this->delete('/api/cart/' . 55)
            ->assertOk()
            ->assertExactJson(['exists' => false]);
    }

    public function testLoadingCartList()
    {
        $cart = $this->createCart();
        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertSessionHas('cart', [$cart]);
        $cart2 = $this->createCart();
        $this->post('/api/cart', $cart2)
            ->assertOk()
            ->assertSessionHas('cart', [$cart, $cart2]);
        $cart3 = $this->createCart();
        $this->post('/api/cart', $cart3)
            ->assertOk()
            ->assertSessionHas('cart', [$cart, $cart2, $cart3]);

        $this->getJson('/' . app()->getLocale() . '/cart')
            ->assertOk()
            ->assertSessionHas('cart', [$cart, $cart2, $cart3]);
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
