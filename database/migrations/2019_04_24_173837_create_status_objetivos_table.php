<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusObjetivosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('status_objetivos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->date('data');

      $table->integer('objetivo_id')->unsigned();
      $table->foreign('objetivo_id')->references('id')->on('objetivos')->onDelete('cascade');

      $table->integer('status_id')->unsigned();
      $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

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
    Schema::dropIfExists('status_objetivos');
  }
}
