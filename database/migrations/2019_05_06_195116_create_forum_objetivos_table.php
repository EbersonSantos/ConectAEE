<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumObjetivosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('forum_objetivos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->integer('objetivo_id');

      $table->foreign('objetivo_id')->references('id')->on('objetivos')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('forum_objetivos');
  }
}
