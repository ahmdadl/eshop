<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(),
        'category_id' => factory(Category::class)->create(),
        'name' => $faker->sentence,
        'price' => $faker->randomFloat(4),
        'save' => rand(0, 100),
        'amount' => rand(1, 3),
        'is_used' => $faker->boolean(),
        'color' => json_encode([$faker->word, $faker->word]),
        'img' => json_encode([rand(1, 5).'.png', rand(1, 5).'.png', rand(1, 5).'.png'])
    ];
});
