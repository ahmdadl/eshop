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

        $this->get('/'.app()->getLocale().'/user/'.$user->id)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testUserCanAccessOnlyHisProfile()
    {
        $user = $this->signIn();
        $user2 = factory(User::class)->create();

        $this->get('/'.app()->getLocale().'/user/'.$user2->id)
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

        $this->get('/'.app()->getLocale().'/user/'.$user->id)
            ->assertOk()
            ->assertSee(5)
            ->assertSee(30);
    }
}
