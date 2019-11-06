<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituicaosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('instituicaos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nome');
      $table->string('telefone',15)->nullable();
      $table->string('email')->nullable();

      $table->integer('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

      $table->integer('endereco_id');
      $table->foreign('endereco_id')->references('id')->on('enderecos');

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
    Schema::dropIfExists('instituicaos');
  }
}
