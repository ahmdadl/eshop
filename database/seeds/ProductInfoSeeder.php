<?php

use App\Product;
use App\ProductInfo;
use Illuminate\Database\Seeder;

class ProductInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $p = Product::all();
        $p->each(function (Product $p) {
            $p->pi()->save(
                factory(ProductInfo::class)->make([
                    'product_id' => $p->id
                ])
            );
        });

        DB::commit();
    }
}
