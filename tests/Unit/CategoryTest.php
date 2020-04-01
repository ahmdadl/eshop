<?php


namespace Tests\Unit;

use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItHasCategories()
    {
        /** @var \App\Category $cat */
        $cat = factory(Category::class)->create();

        $cat->categories()->save(factory(Category::class)->create([
            'category_id' => $cat->id
        ]));

        $this->assertCount(1, $cat->categories);
    }

    public function testItHasSubCategories()
    {
        $cat = factory(Category::class)->create();

        /** @var \App\Category $cat */
        $cat = $cat->categories()->save(factory(Category::class)->create([
            'category_id' => $cat->id
        ]));

        $cat->categories()->save(factory(Category::class)->create([
            'category_id' => $cat->id
        ]));

        $cat = Category::with('subCat')->find($cat->id);

        $this->assertCount(1, $cat->categories);
    }

    public function testItHasManyProducts()
    {
        /** @var \App\Category $cat */
        $cat = factory(Category::class)->create();

        $cat->products()->attach(
            (factory(Product::class)->create())->id
        );

        /** @var \App\Category $cat */
        $cat = Category::first();

        $this->assertIsIterable($cat->products);
    }

    public function testItHasSlug()
    {
        $name = 'some of me Here At me No';

        /** @var \App\Category $cat */
        $cat = new Category([
            'name' => $name
        ]);

        $cat->save();

        $this->assertSame(
            Str::slug(Str::lower($name)),
            $cat->slug
        );
    }

    public function testItHasPath()
    {
        // parent category
        /** @var \App\Category $cat */
        $cat = factory(Category::class)->create();

        $path = '/' . app()->getLocale() . '/c/' . $cat->slug;

        $this->assertSame($path, $cat->path(), 'test parent category');

        // sub category
        /** @var \App\Category $sc */
        $sc = $cat->subCat()->create(
            factory(Category::class)->raw()
        );

        $this->assertSame(
            $path . '/sub/' . $sc->slug,
            $sc->path($cat->slug),
            'testing sub category'
        );
    }
}
