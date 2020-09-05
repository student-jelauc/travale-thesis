<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Geography\City;
use Faker\Generator as Faker;
use App\Entities\Accommodations\Accommodation;

$factory->define(Accommodation::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'city_id' => City::offset(rand(1, City::count() - 1))->first()->id,
        'description' => $faker->text(150),
        'account_id' => \App\Entities\User::whereEmail('jelauc.valerian@gmail.com')->first()->account_id,
    ];
});
