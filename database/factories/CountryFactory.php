<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Geography\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
    ];
});
