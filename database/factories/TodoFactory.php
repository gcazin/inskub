<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->optional()->realText(),
        'deadline' => $faker->dateTimeBetween('2020-04-27'),
        'assigned_to' => random_int(1,10),
        'user_id' => random_int(1,10)
    ];
});
