<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacaosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('notificacaos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('aluno_id');
      $table->integer('remetente_id');
      $table->integer('destinatario_id');
      $table->integer('perfil_id')->nullable();
      $table->integer('objetivo_id')->nullable();
      $table->boolean('lido');
      $table->integer('tipo');  //1 para pediu acesso, 2 para recebeu acesso, 3 para objetivo, 4 atividade, 5 sugestao

      $table->foreign('aluno_id')->references('id')->on('alunos');
      $table->foreign('objetivo_id')->references('id')->on('objetivos');
      $table->foreign('remetente_id')->references('id')->on('users');
      $table->foreign('destinatario_id')->references('id')->on('users');
      $table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade');

      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('notificacaos');
  }
}
