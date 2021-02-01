<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => array_rand([
            'Quels sont les avantages de l’assurance vie ?',
            'Pourquoi recourir à une assurance vie en ligne ?',
            'Comment évoluent les primes d’assurance habitation ?',
            'Comment les mutuelles remboursent l’orthodontie ?',
            'L’assurance dépendance est-elle un bon plan ?',
            'Résiliation assurance auto : quelle est la marche à suivre ?',
            'Comment souscrire une assurance smartphone',
            'Assurance propriétaire non occupant : pourquoi souscrire ?'
        ]),
        'user_id' => User::all()->random()->id,
        'visibility_id' => random_int(1,3),
        'media' => array_rand(array_flip(['1','2','3', '4']), 1) === 1 ? 'posts/Rq71880fVzhIVHXm2WqlB0eHCTPhF7DYyZg0KLrT.jpeg' : null,
        'created_at' => $faker->dateTimeBetween('2020-04-01')
    ];
});
