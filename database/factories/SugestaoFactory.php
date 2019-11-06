<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Sugestao;
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

$factory->define(Sugestao::class, function (Faker $faker) {
    return [
        'titulo' => $faker->words($nb = 3, $asText = true),
        'descricao' => $faker->text($maxNbChars = 500),
        'data' => date('d.m.Y',strtotime("-2 days")),
        'objetivo_id' => 1,
    ];
});
