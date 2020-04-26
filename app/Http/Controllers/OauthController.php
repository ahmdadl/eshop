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
            $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiZGE1MTNhMTFhN2E3YmM0OTY5Y2Y5ODNkNjg2MGU1M2Q0Nzc5YmRhNzkzZjMwODQxYjZlZmJhZTYyMzYyMjlmMjA0YWQ2MzRhOTc2Y2FhOTAiLCJpYXQiOjE1ODc4NzA0OTYsIm5iZiI6MTU4Nzg3MDQ5NiwiZXhwIjoxNjE5NDA2NDk2LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.bcB-ZP-fAjGRU_ad0Fpjcfma5A7eQrRCCzmk2GSQ-BIfQWJJ40ym5Rs5hH9SWu0eZgyszYuH7dwDk3LdJltjn0rL62uauN02OahOVw9Voz1YltrnxH7NTMHe6uXClqMgub6qnGU_YsdoJWN4L1AlVPS_EOTP5pJi42jQgXwybrPrQ4dEDFH_c-zcmjBQe4uP1A4maXSclbT3wJDjUnzBzdYFsNNDwVCk5WqHzyPlKQV3D6xmZo31ovnobfPmq-LM_R1uE-gnTuSjSvpq1caEBdyA_1FQqXLpVA5utODSab0q1GBrtYk8LipuMMWinxzzwG-EUigiB-uOi5Qz2_8rBEpFRSt-odTCm2DYjYTCQt5GReCs_37xQIUXIBK9eu2X_oT8V8rfrGGr5mVU51ZMNP4dRYFwRDGhAdSd-A5GlJ7RRdT3kcfZX4b3-ydwNIPUMmu-zo1iAop-YvdHDHRpgyOGnyfsXV1JBkfFsppdvDGez2ZExX8lc0MTI8TkWJHZ2G3UbAW5JoJPeBnQMXQ0mJ7k50BZMweS2e00-3M-urxBpvHz8x20_4fHWc3ENeKTGcGdhGAtNmOw0axdPzPp4sxwIz_lkytEeSB7soBxkPY34YlOOkuIAaoHOp5nwcRRfFxQHG8_ho2jgdAECx1lq4EE_1gCVRr5NKaYUA868jY";
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
