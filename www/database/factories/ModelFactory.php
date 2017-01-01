<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Tariff::class, function (Faker\Generator $faker) {
    return [
        'title'              => $faker->realText(rand(10,15)),
        'whom'               => $faker->realText(rand(20,40)),
        'additional_service' => $faker->realText(rand(20,50)),
        'top'                => $faker->numberBetween(1, 10),
        'published'          => $faker->numberBetween(0, 1),
    ];
});
