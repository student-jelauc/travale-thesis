<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Geography\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
    ];
});
