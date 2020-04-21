<?php

namespace Tests\Feature;

use App\Client;
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
        $this->createClient();
    }

    public function testOnlyClientOwnerCanUpdateIt()
    {
        $owner = factory(User::class)->create();
        $anyUser = factory(User::class)->create();

        $clientId = $this->createClient($owner);

        $data = $this->clientData();

        $this->put('/oauth/clients/' . $clientId, $data)
            ->assertOk();

        $this->get('/oauth/clients')
            ->assertOk()
            ->assertSee($data['name']);

        // any user cannot update other client
        Passport::actingAs($anyUser);
        $this->put('/oauth/clients/' . $clientId, $data)
            ->assertStatus(404);
    }

    public function testUserCanNotUpdateClientWithInvalidData()
    {
        $clientId = $this->createClient();

        $this->post('/api/oauth/clients/update/' . $clientId, [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['name', 'redirect']);
    }

    public function testUserCanUpdateOwnedClientByOurController()
    {
        $clientId = $this->createClient();

        $data = $this->clientData();

        $this->post('/api/oauth/clients/update/' . $clientId, $data)
            ->assertOk();
    }

    private function clientData(): array
    {
        return $data = [
            'name' => $this->faker->sentence,
            'redirect' => $this->faker->url,
        ];
    }

    private function createClient(
        User $user = null,
        array $data = []
    ): int {
        Passport::actingAs($user ?? factory(User::class)->create());

        $data = $this->clientData();

        $this->post('/oauth/clients', $data)
            ->assertStatus(201);

        $this->get('/oauth/clients')
            ->assertOk()
            ->assertSee($data['name']);

        return Client::latest()->first()->id;
    }
}
