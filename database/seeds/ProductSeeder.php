<?php

use App\Category;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = Category::whereNotNull('category_id')->get();

        DB::beginTransaction();

        $cats->each(function (Category $c) {
            $c->products()->saveMany(
                factory(Product::class, mt_rand(25, 80))->make([
                    'category_slug' => $c->slug,
                ])
            );
        });

        // User::find(2)->products()->saveMany(
        //     factory(Product::class, mt_rand(15, 35))->make()
        // );

        DB::commit();
    }
}
