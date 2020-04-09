<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(),
        'product_id' => factory(Product::class)->create(),
        'address' => $faker->address,
        'amount' => $faker->randomNumber(3),
        'total' => $faker->randomFloat(2, 15, 100000),
        'sent' => $faker->boolean
    ];
});
