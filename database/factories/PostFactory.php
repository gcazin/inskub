<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence(random_int(6,20)),
        'user_id' => random_int(1, 15),
        'visibility_id' => random_int(1,3),
        'media' => array_rand(array_flip(['1','2','3', '4']), 1) === 1 ? 'https://i.picsum.photos/id/'.random_int(1, 200).'/200/200.jpg' : null,
        'created_at' => $faker->dateTimeBetween('2020-04-01')
    ];
});
