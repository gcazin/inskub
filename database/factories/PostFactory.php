<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph(1),
        'user_id' => random_int(1, 5),
        'visibility_id' => random_int(1,3),
        'media' => null,
        'created_at' => $faker->dateTime
    ];
});
