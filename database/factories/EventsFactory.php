<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'about' => $faker->paragraph,
        'location' => $faker->address,
        'eventStart' => $faker->dateTime,
        'eventEnd' => $faker->dateTime,
        'user_id' => $faker->randomDigit
    ];
});
