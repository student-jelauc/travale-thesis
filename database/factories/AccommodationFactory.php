<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Accommodations\AccommodationType;
use App\Entities\Geography\City;
use Faker\Generator as Faker;
use App\Entities\Accommodations\Accommodation;

$factory->define(Accommodation::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->text(150),
        'stars' => rand(0, 5),
    ];
});
