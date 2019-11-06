<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('albums', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nome');
      $table->text('descricao')->nullable();

      $table->integer('aluno_id')->unsigned();
      $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users');

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
    Schema::dropIfExists('albums');
  }
}
