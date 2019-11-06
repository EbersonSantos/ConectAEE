<?php

use Illuminate\Database\Seeder;
use App\Aluno;
use App\ForumAluno;

class ForumAlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alunos = Aluno::all();
        
        foreach ($alunos as $aluno) {
            factory(ForumAluno::class)->create([
                'aluno_id' => $aluno->id,
            ]);
        }
    }
}
