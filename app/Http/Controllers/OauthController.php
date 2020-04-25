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
            $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiN2I4NzVjZDdjZmQ1NWFiNzc3MGYzMWQ1ZGQ4MGI3NGJmNzdmMzQ4Y2U2ODI1NjAyZTMwYzRkYjhkODBhMGM2ZDgzNGM0MzkzMmIyZGU4NTciLCJpYXQiOjE1ODc4MTYxODgsIm5iZiI6MTU4NzgxNjE4OCwiZXhwIjoxNTg3OTAyNTg4LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.VAUdCtejhAejjtSiU1cqKGp6Kqrw790qQOYBdNvS5bb0Ox08ol7sLG_c8DKyKP2G6c2Jvq_j4NF1tDKDSIIII-7uaHZQH2oQUPsCQPkYzCEk-US-8otkrj3xwbldGRLdPaQgp0CtEBbRY7GyQDtS_gf8ca5TByEKNRmxXfJEYMpRrjod9bO-udmnma39wluu5P5qQutyyQ9LyuN2A1Rs34oTomZ6L2vr9Ziq0GIuUCKuqRlvOFwo42W4R3_oHgRI-foa8SgQLC9FdN0baJXUGDQvZQM-6eT8StXXTUfC5Xsq4kXorrSMOgc4C5vUQ1Fjh67JgWkHavUDat_wA_sUrGFF5nDWN_8iO7ot35KhP5jjo5OhXD1jr7cYswg2jI_6FPbpQP7pOrNnfnRhYfiVFLR-wKV5xqf1XAMHZ7bnKBZjxcpBLa2y7xRLk_8Jlqb3cIS-8dCI-F_bZOv5UniGDezCzNzXp-5yUdRnjk_RZjAn26CJZwLY9x_s_yaRpN2a1TgfPelWLZNe1VB-pW-TT7ZfrJPLeIdZLjfhQCVU7h3abYPtTkDe27t8bPtcuHqUJ_rVfukLrISdvofl7ei_C3JqiDm1vHy5rArok2-ovjvHEp8q1h_E0QGZ1TBZBKX7LiJ4YDRjo8K6vxjUBM_f05F7a_AGmlCHCtXl_EZ8y-Y";
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
