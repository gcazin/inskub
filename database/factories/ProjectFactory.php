<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->optional('0.5')->realText('100'),
        'deadline' => $faker->dateTimeBetween(now(), now()->addMonths(3))->format('d/m/Y'),
        'colour' => $faker->rgbCssColor,
        'finish' => $faker->numberBetween(0,1),
        'user_id' => User::all()->random()->id
    ];
});
