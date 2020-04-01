<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

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
                    'category_id' => $c->id
                ])
            );
        });

        DB::commit();
    }
}
