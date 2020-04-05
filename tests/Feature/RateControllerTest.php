<?php

namespace Tests\Feature;

use App\Product;
use App\Rate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RateControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testLoadProductRates()
    {
        /** @var \App\Product $p */
        $p = factory(Product::class)->create();

        $p->rates()->saveMany(
            factory(Rate::class, 13)->make()
        );

        $res = $this->get('/api/p/' . $p->slug . '/rates')
            ->assertOk()
            ->assertJsonCount(7, 'data') // pagination returns 7
            ->decodeResponseJson();

        // test pagination next page
        $this->get($res['next_page_url'])
            ->assertOk()
            ->assertJsonCount(6, 'data');
    }
}
