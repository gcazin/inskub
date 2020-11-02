<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence(random_int(6,20)),
        'user_id' => User::all()->random()->id,
        'visibility_id' => random_int(1,3),
        'media' => array_rand(array_flip(['1','2','3', '4']), 1) === 1 ? 'posts/Rq71880fVzhIVHXm2WqlB0eHCTPhF7DYyZg0KLrT.jpeg' : null,
        'created_at' => $faker->dateTimeBetween('2020-04-01')
    ];
});
