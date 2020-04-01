<?php

namespace Tests\Feature;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
