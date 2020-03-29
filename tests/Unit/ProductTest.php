<?php

namespace Tests\Unit;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testCastsIsWorking()
    {
        /** @var \App\Product $p */
        $p = factory(Product::class)->create();

        $this->assertIsBool($p->is_used);
        $this->assertIsArray($p->color);
        $this->assertIsArray($p->img);

        $colors = ['red', 'blue', 'green'];
        $p->color = $colors;
        $p->update();

        /** @var \App\Product $p */
        $p = Product::find(1);

        $this->assertIsArray($p->color);
        $this->assertSame($colors, $p->color);
    }
}
