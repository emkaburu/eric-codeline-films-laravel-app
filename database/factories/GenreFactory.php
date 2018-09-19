<?php

use Faker\Generator as Faker;

$factory->define(App\Genre::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 2, $variableNbWords = true)
    ];
});
