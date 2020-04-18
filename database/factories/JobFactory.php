<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText(),
        'hours' => 35,
        'salary' => random_int(1100,2000),
        'user_id' => random_int(1,10),
        'type_id' => random_int(1,5)
    ];
});
