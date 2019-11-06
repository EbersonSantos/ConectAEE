<?php

use Faker\Generator as Faker;

$factory->define(App\Endereco::class, function (Faker $faker) {
    return [
      'numero' => $faker->buildingNumber,
      'logradouro' => $faker->streetName,
      'bairro' => $faker->citySuffix,
      'cidade' => 'Garanhuns',
      'estado' => 'PE'
      // 'cidade' => $faker->city,
      // 'estado' => $faker->stateAbbr,
    ];
});
