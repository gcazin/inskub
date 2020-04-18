<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply_post;
use Faker\Generator as Faker;

$factory->define(Reply_post::class, function (Faker $faker) {
    return [
        'message' => $faker->sentence,
        'post_id' => random_int(1,100),
        'user_id' => random_int(1,15),
    ];
});
