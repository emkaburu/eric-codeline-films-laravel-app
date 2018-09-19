<?php

use Faker\Generator as Faker;

$factory->define(App\Film::class, function (Faker $faker) {
	$name = $faker->sentence($nbWords = 3, $variableNbWords = true);
    return [
        'name' => $name,
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        // 'realease_date' => $faker->dateTime($min = 'now'),
        'realease_date' => $faker->dateTimeBetween('+1 week', '+1 month'),
        'rating' => $faker->numberBetween(1,5),
        'ticket_price' => '15.00',
        'country' => $faker->country,
        'genre_id' => 1,
        'photo_url' => 'default-photo.png',
        'slug' => str_slug($name)
    ];
});