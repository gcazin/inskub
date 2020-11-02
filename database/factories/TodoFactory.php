<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use App\Models\Todo;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->optional()->realText(),
        'deadline' => $faker->dateTimeBetween('2020-04-27'),
        'project_id' => Project::all()->random()->id,
        'user_id' => User::all()->random()->id,
        'assigned_to' => User::all()->random()->id
    ];
});
