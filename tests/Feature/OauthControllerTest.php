<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class OauthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testAnyUserCanCreateClient()
    {
        Passport::actingAs(factory(User::class)->create());

        $data = [
            'name' => $this->faker->sentence,
            'redirect' => $this->faker->url
        ];

        $res = $this->post('/oauth/clients', $data)
            ->assertStatus(201);

        $this->get('/oauth/clients')
            ->assertOk()
            ->assertSee($data['name']);
    }
}
