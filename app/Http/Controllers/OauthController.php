<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class OauthController extends Controller
{
    public function update(Client $client) {
        abort_if((int)$client->user_id !== auth()->id(), 404);

        $req = request()->validate([
            'name' => 'required|string|max:255',
            'redirect' => 'required|url'
        ]);

        $client->name = $req['name'];
        $client->redirect = $req['redirect'];
        $client->update();

        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        abort_if((int)$client->user_id !== auth()->id(), 404);

        $client->delete();

        return response(null, 204);
    }
}
