<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\Models\Reply_post;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Reply_post::class, function (Faker $faker) {
    return [
        'message' => $faker->sentence,
        'post_id' => Post::all()->random()->id,
        'user_id' => User::all()->random()->id
    ];
});
