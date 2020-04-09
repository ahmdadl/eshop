<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testUserDashboardRequiresLoggin()
    {
        $user = factory(User::class)->create();

        $this->get('/' . app()->getLocale() . '/user/' . $user->id)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testUserCanAccessOnlyHisProfile()
    {
        $user = $this->signIn();
        $user2 = factory(User::class)->create();

        $this->get('/' . app()->getLocale() . '/user/' . $user2->id)
            ->assertStatus(403);
    }

    public function testUserHasDashboard()
    {
        $user = $this->signIn();

        $user->orders()->saveMany(
            factory(Order::class, 5)->make()
        );

        factory(Product::class, 30)->create([
            'user_id' => $user->id
        ]);

        $this->get('/' . app()->getLocale() . '/user/' . $user->id)
            ->assertOk()
            ->assertSee(5)
            ->assertSee(30);
    }

    public function testUserCanSeeHisOrders()
    {
        $user = $this->signIn();

        $orders = $user->orders()->saveMany(
            factory(Order::class, 80)->make()
        );

        $this->get('/' . app()->getLocale() . '/user/' . $user->id . '/orders')
            ->assertOk()
            ->assertSee($orders->first()->address)
            ->assertSee($orders->find(20)->address)
            ->assertDontSee($orders->find(70)->address)
            ->assertSee("page-item");

        // visit page two
        $this->get('/' . app()->getLocale() . '/user/' . $user->id . '/orders?page=2')
            ->assertOk()
            ->assertSee($orders->find(70)->address)
            ->assertDontSee($orders->find(30)->address)
            ->assertSee('page-item');
    }

    public function testUserCanSeeHisProducts()
    {
        $user = $this->signIn();

        $products = $user->products()->saveMany(
            factory(Product::class, 70)->make()
        );

        $this->get('/' . app()->getLocale() . '/user/' . $user->id . '/products')
            ->assertOk()
            ->assertSee($products->first()->name)
            ->assertSee($products->find(20)->name)
            ->assertDontSee($products->find(70)->name)
            ->assertSee("page-item");

        // visit page two
        $this->get('/' . app()->getLocale() . '/user/' . $user->id . '/products?page=2')
            ->assertOk()
            ->assertSee($products->find(70)->name)
            ->assertDontSee($products->find(30)->name)
            ->assertSee('page-item');
    }
}
