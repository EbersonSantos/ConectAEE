<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjetivosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('objetivos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('titulo');
      $table->text('descricao');
      $table->string('prioridade');
      $table->date('data');
      $table->boolean('concluido')->default(false);

      $table->integer('cor_id')->unsigned()->nullable();
      $table->foreign('cor_id')->references('id')->on('cors');

      $table->integer('aluno_id')->unsigned();
      $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

      $table->integer('tipo_objetivo_id')->unsigned();
      $table->foreign('tipo_objetivo_id')->references('id')->on('tipo_objetivos')->onDelete('cascade');

      $table->timestamps();
      $table->softDeletes();

    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('objetivos');
  }
}
