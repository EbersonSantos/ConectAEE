<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumAlunosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('forum_alunos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->integer('aluno_id');

      $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('forum_alunos');
  }
}
