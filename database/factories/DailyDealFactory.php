<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DailyDeal;
use App\Product;
use Faker\Generator as Faker;

$factory->define(DailyDeal::class, function (Faker $faker) {
    return [
        'product_id' => factory(Product::class)
    ];
});
