<?php

use Illuminate\Database\Seeder;
use App\AlunoInstituicao;
use App\Aluno;

class AlunoInstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $alunos = Aluno::all();

      foreach($alunos as $aluno){
        for ($i=1; $i<=2 ; $i++) {
          factory(AlunoInstituicao::class)->create([
            'aluno_id' => $aluno->id,
            'instituicao_id' => $i,
          ]);
        }
      }

    }
}
