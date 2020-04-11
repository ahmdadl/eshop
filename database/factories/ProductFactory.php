<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Http\BrandList;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {


    return [
        'user_id' => factory(User::class)->create(),
        // 'category_slug' => (factory(Category::class)->create())->slug,
        'name' => $faker->sentence,
        'info' => $faker->text,
        'price' => $faker->randomFloat(1, 50, 100000),
        'save' => rand(0, 99),
        'amount' => rand(1, 25),
        'is_used' => $faker->boolean(),
        'brand' => BrandList::getBrand(),
        'color' => [$faker->word, $faker->word],
        'img' => [rand(1, 15) . '.jpg', rand(1, 15) . '.jpg', rand(1, 15) . '.jpg']
    ];
});
