<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Freight;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Freight::class, function (Faker $faker) {
    return [

        'freight_details' => Str::slug($faker->unique()->safeEmail),

        'phone' => Str::slug($faker->randomDigitNot(12)),

        'address' => Str::slug($faker->sentence),

        'longitude' => Str::slug($faker->randomDigitNot(50)),

        'latitude' => Str::slug($faker->randomDigitNot(50)),
    ];
});
