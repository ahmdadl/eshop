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
        $cats = factory(Category::class, 7)->create([
            'category_id' => null
        ]);

        $cats->each(function (Category $c) {
            $c->categories()->createMany(
                factory(Category::class, mt_rand(3, 12))->raw([
                    'category_id' => $c->id
                ])
            );
        });
    }
}
