<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $catsArr = [
            'fashion',
            'super market',
            'mobiles & tablets',
            'electronics',
            'home',
            'toys',
            'sports'
        ];

        foreach (range(0, 6) as $i) {
            $c = Category::create([
                'category_id' => null,
                'name' => $catsArr[$i]
            ]);

            $c->categories()->createMany(
                factory(Category::class, mt_rand(3, 6))->raw([
                    'category_id' => $c->id
                ])
            );
        }

        // $cats = Category::whereNull('category_id')->get();

        // $cats->each(function (Category $c) {
        //     $c->categories()->createMany(
        //         factory(Category::class, mt_rand(3, 12))->raw([
        //             'category_id' => $c->id
        //         ])
        //     );
        // });

        DB::commit();
    }
}
