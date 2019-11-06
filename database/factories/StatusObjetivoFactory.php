<?php

use App\StatusObjetivo;
use Illuminate\Support\Str;
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

$factory->define(StatusObjetivo::class, function (Faker $faker) {
    return [
        'data' => new DateTime(),
        'objetivo_id' => 1,
        'status_id' => 1.
    ];
});
