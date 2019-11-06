<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\MensagemForumAluno;

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

$factory->define(MensagemForumAluno::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'forum_aluno_id' => 1,
        'texto' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
