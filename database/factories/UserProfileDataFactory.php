<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserExperience;
use App\UserFormation;
use Faker\Generator as Faker;

$factory->define(UserFormation::class, function (Faker $faker) {
    return [
        'school' => $faker->word,
        'degree' => $faker->word,
        'study_area' => $faker->word,
        'start_date' => $faker->year,
        'finish_date' => $faker->year,
        'description' => $faker->sentence,
        'media' => null,
        'user_id' => random_int(1,15),
    ];
});

$factory->define(UserExperience::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'enterprise' => $faker->company,
        'location' => $faker->city,
        'start_date' => $faker->year,
        'finish_date' => $faker->year,
        'sector' => $faker->word,
        'description' => $faker->sentence,
        'media' => null,
        'user_id' => random_int(1, 15),
    ];
});
