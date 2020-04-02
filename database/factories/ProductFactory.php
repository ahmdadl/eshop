<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(),
        'name' => $faker->sentence,
        'info' => $faker->text,
        'price' => $faker->randomFloat(1, 50, 100000),
        'save' => rand(0, 100),
        'amount' => rand(1, 3),
        'is_used' => $faker->boolean(),
        'color' => [$faker->word, $faker->word],
        'img' => [rand(1, 5).'.png', rand(1, 5).'.png', rand(1, 5).'.png']
    ];
});
