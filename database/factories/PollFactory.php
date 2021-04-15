<?php

use Faker\Generator as Faker;

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

$factory->define(App\Poll::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
    ];
});

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'question' => $faker->sentence,
        'poll_id' => $faker->randomElement(App\Poll::pluck('id')->toArray()),
    ];
});

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        'answer' => $faker->paragraph($nb = 6, $asText = true),
        'question_id' => $faker->randomElement(App\Question::pluck('id')->toArray()),
    ];
});
