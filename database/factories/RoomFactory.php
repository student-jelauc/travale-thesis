<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Accommodations\Facility;
use App\Entities\Accommodations\Room;
use App\Entities\Accommodations\RoomType;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name' => $faker->countryCode[0] . $faker->numberBetween(1, 100),
        'floor' => $faker->numberBetween(1, 15),
        'description' => $faker->text(100),
        'adults_capacity' => $faker->numberBetween(1, 4),
        'children_capacity' => $faker->numberBetween(0, 2),
        'infants_capacity' => 0,
    ];
});
