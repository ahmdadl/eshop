<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductInfo;
use Faker\Generator as Faker;

$factory->define(ProductInfo::class, function (Faker $faker) {
    $info_arr = [
        'brand' => $faker->sentence,
        'package_thickness' => $faker->randomFloat(4),
        'product_weight' => $faker->randomFloat(4),
        'package_weight' => $faker->randomFloat(5),
        'serial_scan_required' => false
    ];

    for ($i = 0; $i < rand(5, 15); $i++) {
        $key = $faker->sentence(3);
        $value = rand(0, 1)===1 ? $faker->randomDigit : $faker->sentence(4);
        
        // check if this key is not already in info array
        if (!isset($info_arr[$key])) {
            $info_arr[$key] = $value;
        }
    }

    return [
        'info' => $info_arr
    ];
});
