<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'role_id' => random_int(2,5),
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'email' => $faker->email,
        'password' => Hash::make('secret'),
        'avatar' => 'https://randomuser.me/api/portraits/'.array_rand(array_flip(['men', 'women']), 1).'/'.random_int(1,99).'.jpg'
    ];
});
