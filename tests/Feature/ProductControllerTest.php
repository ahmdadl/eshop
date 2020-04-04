<?php

namespace Tests\Feature;

use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\CategoryFactory;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testItWillShowCategoryMenu()
    {
        /** @var \App\Category $c */
        $c = factory(Category::class)->create();

        /** @var \App\Category $sc */
        $sc = $c->subCat()->create(
            factory(Category::class)->raw()
        );

        $this->assertDatabaseHas('categories', $sc->only('slug'));

        /** @var \App\Category $randCategory */
        $randCategory = factory(Category::class)->create();
        $randCategory->subCat()->create(
            factory(Category::class)->raw()
        );

        $this->get($sc->path($c->slug))
            ->assertOk()
            ->assertSee($c->name)
            ->assertSee($sc->name)
            ->assertSee($randCategory->name);
    }

    public function testRetrivingProductList()
    {
        /** @var \App\Category $c */
        /** @var \App\Category $sc */
        /** @var \App\Product $p */
        [$c, $sc, $p] = CategoryFactory::wSub(1)->wPro()->create();
        
        $this->get('/api/sub/' . $sc->slug)
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function testLoadProductsWithBrandFilter()
    {
        /** @var \App\Category $c */
        /** @var \App\Category $sc */
        /** @var \App\Product[] $p */
        [$c, $sc, $p] = CategoryFactory::wSub(1)->wPro(4)->create();
        $sc->load('productsMini');

        $brands = Arr::pluck($p, 'brand');
        $brands = Arr::shuffle($brands);
        $brands = implode(',', $brands);

        $this->get("/api/sub/$sc->slug/filterBrands/$brands")
            ->assertOk()
            ->assertJsonCount(4)
            ->assertSee($p[2]->slug);
    }

    public function testLoadProductsWithCondition()
    {
        /** @var \App\Category $c */
        /** @var \App\Category $sc */
        /** @var \App\Product[] $p */
        [$c, $sc] = CategoryFactory::wSub()->create();

        $p = $sc->products()->saveMany(
            factory(Product::class, 4)->make([
                'category_slug' => $sc->slug,
                'is_used' => false
            ])
        );

        $sc->products()->save(factory(Product::class)->make([
            'category_slug' => $sc->slug,
            'is_used' => true
        ]));

        $this->get("/api/sub/$sc->slug/filterCondition/0")
            ->assertOk()
            ->assertJsonCount(4)
            ->assertSee($p[2]->slug);
    }
}
