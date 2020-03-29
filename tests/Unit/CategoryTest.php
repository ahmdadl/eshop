<?php


namespace Tests\Unit;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItHasCategories()
    {
        /** @var \App\User $cat */
        $cat = factory(Category::class)->create();

        $cat->categories()->save(factory(Category::class)->create([
            'category_id' => $cat->id
        ]));

        $this->assertCount(1, $cat->categories);
    }
}
