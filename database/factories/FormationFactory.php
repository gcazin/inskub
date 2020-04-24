<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Formation;
use Faker\Generator as Faker;

$factory->define(Formation::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText(),
        'location' => $faker->city,
        'entry_price' => random_int(1100,2000),
        'user_id' => 4,
    ];
});
