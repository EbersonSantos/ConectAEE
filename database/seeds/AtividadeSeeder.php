<?php

use Illuminate\Database\Seeder;
use App\Aluno;
use App\Objetivo;
use App\Atividade;

class AtividadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objetivos = Objetivo::all();

        foreach($objetivos as $objetivo){
          for ($i=0; $i<2 ; $i++) {
            factory(Atividade::class)->create([
                'objetivo_id' => $objetivo->id,
            ]);
          }
        }
    }
}
