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
        'rate' => $faker->randomFloat(1, 0, 5),
        'message' => $faker->sentence,
        // 'created_at' => ($faker->dateTime)->format('Y-m-d H:i:s'),
        // 'updated_at' => ($faker->dateTime)->format('Y-m-d H:i:s')
    ];
});
