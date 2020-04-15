<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testAnyOneCanAddToCart()
    {
        // $this->withoutExceptionHandling();
        $this->initSessionArray();
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
        $this->initSessionArray();
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
        $this->initSessionArray();
        $cart = $this->createCart(null, 5);

        /** @var \App\Product $p */
        $p = $cart['product'];

        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertSessionHas('cart', [$cart]);

        $cart['amount'] = 25;
        $cart['total'] = 60;

        $this->patch('/api/cart/' . $p->id, ['amount' => 25, 'total' => 60])
            ->assertOk()
            ->assertSessionHas('cart', [$cart])
            ->assertExactJson(['updated' => true]);
    }

    public function testUpdatingCartRequiresItemExists()
    {
        $this->initSessionArray();
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
        $this->initSessionArray();
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
        $this->initSessionArray();

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
        $this->initSessionArray();
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

        $this->getJson('/api/cart')
            ->assertOk()
            ->assertSessionHas('cart', [$cart, $cart2, $cart3]);
    }

    public function testOnlyAuthriedUsersCanCheckout()
    {
        $this->get('/en/cart/checkout')
            ->assertStatus(302);

        $this->post('/en/cart/checkout', [])
            ->assertStatus(302);
    }

    public function testUserCanNotChekoutCartWithInvalidData()
    {
        $this->signIn();

        $this->post('/en/cart/checkout', [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['fname', 'lname', 'address', 'card']);
    }

    public function testUserCanCheckoutCart()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();

        $cart = $this->createCart();
        $this->post('/api/cart', $cart);
        $cart = $this->createCart();
        $this->post('/api/cart', $cart);
        $cart3 = $this->createCart();
        $this->post('/api/cart', $cart3);

        $userNameArr = explode(' ', $user->name);

        $this->post('/en/cart/checkout', [
            'fname' => $userNameArr[0],
            'lname' => $userNameArr[1],
            'address' => $this->faker->address,
            'card' => $this->faker->creditCardNumber
        ])->assertStatus(302)
            ->assertSessionDoesntHaveErrors()
            ->assertSessionHas('cart', [])
            ->assertSessionHas('success');

        $this->assertDatabaseHas('orders', ['product_id' => $cart['id']]);
        $this->assertDatabaseHas('orders', ['product_id' => $cart3['id']]);
    }

    public function testUserCanNotCheckoutIfNoItemsInCart()
    {
        // $this->withoutExceptionHandling();
        $user = $this->signIn();

        $this->get('/en/cart/checkout')
            ->assertOk()
            ->assertSee('alert-warning')
            ->assertDontSee('alert-success')
            ->assertDontSee('alert-danger')
            ->assertDontSee('fname');
    }

    public function testCartWillBeCheckProductRemaningAmount()
    {
        $cart = $this->createCart();
        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertSessionHas('cart', [$cart]);
        $product = factory(Product::class)->create();
        $cart2 = $this->createCart($product);
        $this->post('/api/cart', $cart2)
            ->assertOk()
            ->assertSessionHas('cart', [$cart, $cart2]);

        $this->getJson('/api/cart')
            ->assertOk();

        // CONSIDER another user checkout a product with full amount
        // THEN we will check for product amount on very cart loading
        $product->amount = 0;
        $product->update();

        $cart2['product']['amount'] = 0;

        // get the cart again
        $this->getJson('/api/cart')
            ->assertOk()
            ->assertSessionHas('cart', [$cart, $cart2]);
    }

    public function testCartCanNotCheckedIfProductAmountIsOut()
    {
        // $this->withoutExceptionHandling();
        $user = $this->signIn();

        $product = factory(Product::class)->create(['amount' => 3]);
        $cart = $this->createCart($product, 5);
        $this->post('/api/cart', $cart)
            ->assertOk()
            ->assertSessionHas('cart', [$cart]);

        $userNameArr = explode(' ', $user->name);

        $this->post('/en/cart/checkout', [
            'fname' => $userNameArr[0],
            'lname' => $userNameArr[1],
            'address' => $this->faker->address,
            'card' => $this->faker->creditCardNumber
        ])->assertStatus(403);
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

    private function initSessionArray()
    {
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
    }
}
