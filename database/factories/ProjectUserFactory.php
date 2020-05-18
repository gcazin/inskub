<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ProjectUser;
use Faker\Generator as Faker;

$factory->define(ProjectUser::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1,10),
        'project_id' => random_int(1,5)
    ];
});
