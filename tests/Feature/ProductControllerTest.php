<?php

namespace Tests\Feature;

use App\Category;
use App\DailyDeal;
use App\Product;
use App\ProductInfo;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\CategoryFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
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

        $this->get($sc->path($c->slug))
            ->assertOk();
        // ->assertSeeText($c->name)
        // ->assertSeeText($sc->name);
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
            ->assertJsonCount(4, 'data')
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
            ->assertJsonCount(4, 'data')
            ->assertSee($p[2]->slug);
    }

    public function testFilterDataByPrice()
    {
        $this->withoutExceptionHandling();
        /** @var \App\Category $c */
        /** @var \App\Category $sc */
        /** @var \App\Product[] $p */
        [$c, $sc, $p] = CategoryFactory::wSub(1)->wPro(10)->create();

        $from = 1;
        $to = 1000000;

        $this->get("/api/sub/$sc->slug/priceFilter/$from/$to")
            ->assertOk();
    }

    public function testShowingProductData()
    {
        $this->withoutExceptionHandling();
        /** @var \App\Category $c */
        /** @var \App\Category $sc */
        /** @var \App\Product[] $p */
        [$c, $sc, $p] = CategoryFactory::wSub(1)->wPro(10)->create();

        $this->get(app()->getLocale() . '/p/' . $p[0]->slug)
            ->assertOk()
            ->assertSee($p[0]->name);
    }

    public function testAnyOneCanSearchForProducts()
    {
        $this->withoutExceptionHandling();
        /** @var \App\Category $c */
        /** @var \App\Category $sc */
        /** @var \App\Product[] $p */
        [$c, $sc, $p] = CategoryFactory::wSub(1)->wPro(10)->create();

        $p = $p[4];

        $q = urlencode(trim(Str::lower(substr($p->name, 4, 5))));

        $this->get(app()->getLocale() . '/p/ser/?q=' . $q)
            ->assertOk()
            ->assertSee($p->name)
            ->assertSee($p->price);

        $q = substr($p->brand, 1);

        $this->get(app()->getLocale() . '/p/ser/?q=' . $q)
            ->assertOk()
            ->assertSee($p->name)
            ->assertSee($p->price);
    }

    public function testLoadingDailyDeals()
    {
        $this->withoutExceptionHandling();
        $deals = factory(DailyDeal::class, 20)->create();

        $this->get('/' . app()->getLocale() . '/daily')
            ->assertOk()
            ->assertSee($deals[0]->product->name);
    }

    public function testGuestCanNotAddProduct()
    {
        $this->post('/' . app()->getLocale() . '/user/1/p', [])
            ->assertStatus(302);
    }

    public function testUserCanAddProductForHimSelfOnly()
    {
        $this->signIn();
        $user = factory(User::class)->create();

        $this->post('/en/user/' . $user->id . '/p', [])
            ->assertStatus(403);
    }

    public function testUserCanNotAddProductWithInvalidData()
    {
        // $this->withoutExceptionHandling();
        $user = $this->signIn();

        $this->post('/en/user/' . $user->id . '/p', [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['name', 'brand', 'info', 'price', 'amount', 'save', 'color']);
    }

    public function testUserCanAddProduct()
    {
        // $this->withoutExceptionHandling();
        $user = $this->signIn();

        /** @var \App\Category $c */
        /** @var \App\Category $sc */
        /** @var \App\Product $p */
        [$c, $sc] = CategoryFactory::wSub()->create();

        $p = factory(Product::class)->make([
            'category_id' => $sc->id
        ]);

        $pData = [
            'cat' => $c->id,
            'subCat' => $sc->id,
            'name' => $p->name,
            'brand' => $p->brand,
            'info' => $p->info,
            'price' => $p->price,
            'amount' => $p->amount,
            'save' => $p->save,
            'color' => implode(',', $p->color),
            'is_new' => $p->is_used
        ];

        $this->post('/en/user/' . $user->id . '/p', $pData)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();

        $this->get('/en/user/' . $user->id . '/products')
            ->assertSee($p->name)
            ->assertSee($p->rate_avg);

        $this->assertDatabaseHas('products', [
            'name' => $p->name,
            'category_slug' => $sc->slug
        ]);
    }

    public function testGuestCanNotDeleteProduct()
    {
        $this->delete('/en/p/some-name')
            ->assertStatus(302);
    }

    public function testUserCanDeleteOnlyHisProducts()
    {
        $user = factory(User::class)->create();

        $user2 = $this->signIn();

        $slug = Str::slug('some of me is here');
        $p = $user->products()->save(
            factory(Product::class)->make([
                'slug' => $slug
            ])
        );

        $this->delete('/en/p/' . $slug)
            ->assertStatus(403);

        $this->actingAs($user)->deleteJson('/en/p/' . $slug)
            ->assertOk()
            ->assertExactJson(['deleted' => true]);

        $this->assertDatabaseMissing('products', ['slug' => $slug]);
    }

    public function testAdminCanDeleteAnyProduct()
    {
        $user = $this->signIn(['role' => User::AdminRole]);

        $user2 = factory(User::class)->create();

        $slug = Str::slug('some of me is here');
        $user2->products()->save(
            factory(Product::class)->make([
                'slug' => $slug
            ])
        );

        $this->deleteJson('/en/p/' . $slug)
            ->assertOk()
            ->assertExactJson(['deleted' => true]);

        $this->assertDatabaseMissing('products', ['slug' => $slug]);
    }
}
