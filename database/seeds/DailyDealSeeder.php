<?php

use App\DailyDeal;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DailyDealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        DB::beginTransaction();

        $ids = Arr::random($products->pluck('id')->toArray(), mt_rand(70, 130));

        foreach ($ids as $id) {
            DailyDeal::create([
                'product_id' => $id
            ]);
        }

        DB::commit();
    }
}
