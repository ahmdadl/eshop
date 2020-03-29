<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        "name" => $faker->sentence,
        'category_id' => rand(0, 1)===1 ? null : factory(Category::class)
    ];
});
