<?php

use Illuminate\Database\Seeder;
use App\Gerenciar;
use App\Aluno;
use App\User;

class GerenciarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alunos = Aluno::all();
        $users_count = count(User::all());

        foreach ($alunos as $aluno) {
            $array = range(2,8);
            unset($array[2]);
            shuffle($array);

            $array_users = range(2,count(User::all()));
            shuffle($array);

            factory(Gerenciar::class)->create([
                'aluno_id' => $aluno->id,
                'perfil_id' => array_pop($array),
                'user_id' => 1,
                'isAdministrador' => True,
            ]);
            factory(Gerenciar::class)->create([
                'aluno_id' => $aluno->id,
                'perfil_id' => 1,
                'user_id' => array_pop($array_users),
                'isAdministrador' => True,
            ]);
            factory(Gerenciar::class)->create([
                'aluno_id' => $aluno->id,
                'perfil_id' => array_pop($array),
                'user_id' => array_pop($array_users),
                'isAdministrador' => False,
            ]);
        }
        //factory(Gerenciar::class, count(Aluno::all()))->create();
    }
}
