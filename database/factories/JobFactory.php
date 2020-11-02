<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'description' => $faker->catchPhrase,
        'hours' => 35,
        'salary' => random_int(1100,2000),
        'user_id' => User::all()->random()->id,
        'type_id' => random_int(1,5)
    ];
});
