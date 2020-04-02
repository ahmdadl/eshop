<?php

namespace Tests\Feature;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\CategoryFactory;
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
        $sc->load('productsMini');

        $this->get('/api/sub/' . $sc->slug)
            ->assertOk()
            ->assertExactJson($sc->toArray());
    }
}
