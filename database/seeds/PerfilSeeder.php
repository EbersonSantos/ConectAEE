<?php

use Illuminate\Database\Seeder;
use App\Perfil;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Perfil::class)->create([
            'nome' => "Responsável",
            'especializacao' => NULL,
        ]);

        factory(Perfil::class)->create([
            'nome' => "Professor AEE",
            'especializacao' => NULL,
        ]);

        factory(Perfil::class)->create([
            'nome' => "Professor Regular",
            'especializacao' => NULL,
        ]);

        factory(Perfil::class)->create([
            'nome' => "Profissional Externo",
            'especializacao' => NULL,
        ]);

        factory(Perfil::class)->create([
            'nome' => "Profissional Externo",
            'especializacao' => 'Psicólogo',
        ]);

        factory(Perfil::class)->create([
            'nome' => "Profissional Externo",
            'especializacao' => 'Fisioterapeuta',
        ]);

        factory(Perfil::class)->create([
            'nome' => "Profissional Externo",
            'especializacao' => 'Terapeuta Ocupacional',
        ]);

        factory(Perfil::class)->create([
            'nome' => "Profissional Externo",
            'especializacao' => 'Fonoaudiólogo',
        ]);
    }
}
