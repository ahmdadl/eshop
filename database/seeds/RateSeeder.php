<?php

use App\Product;
use App\Rate;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        $users_ids = ((User::all())->pluck('id'))->toArray();
        $f = Factory::create();

        (Product::all())->each(function (Product $p) use ($users_ids, $f) {
            for ($i = 0; $i < mt_rand(7, 15); $i++) {
                DB::table('rates')->insert([
                    'user_id' => Arr::random($users_ids),
                    'product_id' => $p->id,
                    'rate' => $f->randomFloat(1, 0, 5),
                    'message' => $f->text(254),
                    // 'created_at' => ($f->dateTime)->format('Y-m-d H:i:s'),
                    'updated_at' => ($f->dateTimeThisMonth)->format('Y-m-d H:i:s')
                ]);
            }
        });
        DB::commit();
    }
}
