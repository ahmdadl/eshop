<?php

namespace App\Http\Controllers;

use App\Client;
use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OauthController extends Controller
{
    public function update(Client $client)
    {
        abort_if((int) $client->user_id !== auth()->id(), 404);

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
        abort_if((int) $client->user_id !== auth()->id(), 404);

        $client->delete();

        return response(null, 204);
    }

    public function test(Request $request, GuzzleHttpClient $http)
    {
        $req = $request->all();
        $method = $req['method'];
        $token = $req['token'];
        $url = $req['url'];

        if (Str::contains($token, '*') || strlen($token) < 50) {
            $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiYWMwYzk3ODcxMDNiMDA5M2FlYTMyZDg1ODJlMWQ1MmRjZTJlNDhkZDVkZjY0YTE1NTliNzdiYWYyNTdhMzU0OWY5YTA1ZWZlOWY1ZjU1ZjgiLCJpYXQiOjE1ODc4Mjg3ODAsIm5iZiI6MTU4NzgyODc4MCwiZXhwIjoxNjE5MzY0Nzc5LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.Y8ZbO63TsLM5p47xZGLcCVn5YtE6zHgoFUCF6Zr8uV1XX3cMo-AkuG-LBwczZM0YqNBcsdm3_pv0oAbH5woMmfomTXR07i4XUD-AkXeaXcvdhp1OOBbMfg4g9sOz2SHbWK59XOxRhftRltYSGET72pMhQ7j8z1gpxrKPUrHRJ38-_y-cVPtRQRyEHNEaMxVzc5jtkm_lPlDEyBbFAaWF6DyjSuxiZerJ7010zRwzp1tVRmRJmj3uDPZhwlq2uQksvmBJ8vqis5dG7vOY2eo3Ki43VytvK9kkx4IJK7gqDGHCX5pW_AHS1XzWzTntnh21HKlcvKX3cQWpifxVZAIXkuo4SLUYVbiWu2_KWP5oJErB0auVoqvrnitM1BqOExQY--vyuvCtRMtDIbr964IEAsFCk7oGQPkKJSXbIYWSUTRlOlkyWdvdjvDpu82LtaX83OAa_8BYLpI1YM37JJsvYvKzWZSOh7kI9ByxbNAqqDJYgfycZ8MmXOdqSKDN3ZHRBeFk3kA8kEe5TUXX_rTul9K7ejgVGPpRo23FuPJfZeLXGsgq_6YhHOvOoPT5cyTDYVkWA5_wIYyOwMFLuhfUWAGsq6NavPzrG6gpS1krx7uY1uAOahyC-IDno1ZzmT9DjDyxQj54DtIdWMr2a0YOv-fVzvJURXG1nxdco4QYUtM";
        }

        unset($req['client_id']);
        unset($req['method']);
        unset($req['token']);
        unset($req['url']);

        $opt = [
            'headers' => [
                'Accept' => 'application/json',
                'authorization' => "Bearer $token"
            ]
        ];

        if (sizeof($req)) {
            $opt["form_fields"]  = $req;
        }

        try {
            $res = $http->request($method, $url, $opt);
            $status = $res->getStatusCode();
            $body = $res->getBody();
        } catch (ClientException $e) {
            $status = $e->getResponse()->getStatusCode();
            $body = $e->getResponse()->getBody(true);
        }

        return response(
            $body,
            $status,
            ['Content-Type' => 'application/json;charset=utf8']
        );
    }
}
