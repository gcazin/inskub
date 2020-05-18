<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->optional('0.5')->realText('100'),
        'deadline' => $faker->dateTimeBetween('2020-04-27'),
        'colour' => $faker->rgbCssColor,
        'finish' => $faker->numberBetween(0,1),
        'user_id' => random_int(1,10)
    ];
});
