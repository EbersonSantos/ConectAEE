<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagemForumObjetivosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('mensagem_forum_objetivos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();

      $table->string('texto');
      $table->integer('user_id');
      $table->integer('forum_objetivo_id');

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('forum_objetivo_id')->references('id')->on('forum_objetivos')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('mensagem_forum_objetivos');
  }
}
