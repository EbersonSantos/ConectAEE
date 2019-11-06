<?php

use Illuminate\Database\Seeder;
use App\Aluno;
use App\Objetivo;
use App\Sugestao;

class SugestaoSeeder extends Seeder
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
          for ($i=1; $i<=2 ; $i++) {
            factory(Sugestao::class)->create([
                'objetivo_id' => $objetivo->id,
                'data' => date('d.m.Y',strtotime("-".$i." days")),
                'user_id' => $i
            ]);
          }
        }
    }
}
