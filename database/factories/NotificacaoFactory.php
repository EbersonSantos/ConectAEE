<?php

use App\Notificacao;
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

$factory->define(Notificacao::class, function (Faker $faker) {
    return [
        'aluno_id' => 1,
        'remetente_id' => 1,
        'destinatario_id' => 1,
        'perfil_id' => 1,
        'lido' => false,
        'tipo' => 1,
    ];
});
