<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSugestaosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('sugestaos', function (Blueprint $table) {
      $table->bigIncrements('id');

      $table->string('titulo');
      $table->text('descricao')->nullable();
      $table->date('data');

      $table->integer('objetivo_id')->unsigned();
      $table->foreign('objetivo_id')->references('id')->on('objetivos')->onDelete('cascade');

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
    Schema::dropIfExists('sugestaos');
  }
}
