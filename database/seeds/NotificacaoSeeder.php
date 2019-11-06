<?php

use Illuminate\Database\Seeder;
use App\Notificacao;

class NotificacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      factory(Notificacao::class)->create([
        'aluno_id' => 1,
        'remetente_id' => 3,
        'destinatario_id' => 1,
      ]);

      factory(Notificacao::class)->create([
        'aluno_id' => 2,
        'remetente_id' => 3,
        'destinatario_id' => 1,
      ]);

      factory(Notificacao::class)->create([
        'aluno_id' => 3,
        'remetente_id' => 3,
        'destinatario_id' => 1,
      ]);

    }
}
