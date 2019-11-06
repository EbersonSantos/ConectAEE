<?php

use Illuminate\Database\Seeder;
use App\MensagemForumAluno;
use App\Aluno;
use App\Gerenciar;

class MensagemForumAlunoSeeder extends Seeder
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
            $gerenciars = Gerenciar::where('aluno_id','=',$aluno->id)->get();
            for ($i=0; $i<5 ; $i++) { 
                foreach ($gerenciars as $gerenciar) {
                    factory(MensagemForumAluno::class)->create([
                        'forum_aluno_id' => $aluno->forum->id,
                        'user_id' => $gerenciar->user->id,
                    ]);
                }
            }
        }
    }
}