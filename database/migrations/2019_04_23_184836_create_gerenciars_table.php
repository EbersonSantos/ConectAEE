<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerenciarsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('gerenciars', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->boolean('isAdministrador')->default(False);
      $table->integer('user_id');
      $table->integer('aluno_id');
      $table->integer('perfil_id')->nullable();

      $table->unique(['user_id','aluno_id']);

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
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
    Schema::dropIfExists('gerenciars');
  }
}
