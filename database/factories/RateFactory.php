<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Rate;
use App\User;
use Faker\Generator as Faker;

$factory->define(Rate::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(),
        'product_id' => factory(Product::class)->create(),
        'rate' => rand(0, 5),
        'message' => $faker->sentence
    ];
});
