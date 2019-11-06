<?php

use Illuminate\Database\Seeder;
use App\TipoObjetivo;

class TipoObjetivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TipoObjetivo::class)->create([
            'tipo' => "Educação",
        ]);

        factory(TipoObjetivo::class)->create([
            'tipo' => "Saúde",
        ]);
    }
}
