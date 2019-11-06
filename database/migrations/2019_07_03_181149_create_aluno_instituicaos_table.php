<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoInstituicaosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('aluno_instituicaos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('aluno_id');
      $table->integer('instituicao_id');

      $table->foreign('aluno_id')->references('id')->on('alunos');
      $table->foreign('instituicao_id')->references('id')->on('instituicaos');

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
    Schema::dropIfExists('aluno_instituicaos');
  }
}
