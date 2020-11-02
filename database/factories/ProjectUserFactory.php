<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Model;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(ProjectUser::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'project_id' => Project::all()->random()->id
    ];
});
