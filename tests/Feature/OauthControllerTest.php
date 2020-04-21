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

    public function testUserCanUpdateOwnedClientByOauthController()
    {
        $owner = factory(User::class)->create();

        $clientId = $this->createClient($owner);

        $data = $this->clientData();

        $this->actingAs($owner)->post('/api/oauth/clients/update/' . $clientId, $data)
            ->assertOk();
    }

    public function testUserCanDeleteOwnedClients()
    {
        $owner = factory(User::class)->create();

        $clientId = $this->createClient($owner);

        // user cannot delete others clients
        Passport::actingAs(factory(User::class)->create());
        $this->delete("/oauth/clients/$clientId")
            ->assertStatus(404);

        // user can delete owned clients
        Passport::actingAs($owner);
        $this->delete("/oauth/clients/$clientId")
            ->assertStatus(204);
    }

    public function testUserCanDeleteOwnedClientByOauthController()
    {
        $owner = factory(User::class)->create();
        $clientId = $this->createClient($owner);

        // user cannot delete others clients
        $this->actingAs(factory(User::class)->create())->post("/api/oauth/clients/$clientId/delete")
            ->assertStatus(404);

        // user can delete owned clients
        $this->actingAs($owner)->post("/api/oauth/clients/$clientId/delete")
            ->assertStatus(204);
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
