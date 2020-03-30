<?php

namespace Tests\Unit;

use App\Category;
use App\CategoryProduct;
use App\Product;
use App\ProductInfo;
use App\Rate;
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

    public function testItBelongsToCategory()
    {
        /** @var \App\Product $p */
        $p = factory(Product::class)->create();

        $p->categories()->attach(
            (factory(Category::class)->create())->id
        );
        $p->categories()->attach(
            (factory(Category::class)->create())->id
        );

        $p = Product::first();

        $this->assertIsIterable($p->categories);
        $this->assertCount(2, $p->categories);
    }

    public function testItHasInfo()
    {
        /** @var \App\Product $p */
        $p = factory(Product::class)->create();

        $info = factory(ProductInfo::class)->raw();

        $p->pi()->create($info);

        /** @var \App\Product $p */
        $p = Product::first();

        $this->assertIsArray($p->pi->info);
        $this->assertSame($info['info'], $p->pi->info);
    }

    public function testItHasRates()
    {
        /** @var \App\Product $p */
        $p = factory(Product::class)->create();

        $p->rates()->create(factory(Rate::class)->raw([
            'product_id' => $p->id
        ]));

        $this->assertCount(1, $p->rates);
    }

    public function testItHasRateAverage()
    {
        /** @var \App\Product $p */
        $p = factory(Product::class)->create();

        $p->rates()->createMany(factory(Rate::class, rand(10, 25))->raw([
            'product_id' => $p->id
        ]));

        $avg = round($p->rates->average('rate'), 1); 

        $this->assertSame($avg, $p->getRateAvg());
        $this->assertLessThanOrEqual(5, $p->getRateAvg());
        $this->assertIsFloat($p->getRateAvg());
    }
}
