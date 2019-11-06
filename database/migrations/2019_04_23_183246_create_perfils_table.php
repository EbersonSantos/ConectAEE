<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('perfils', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nome');
      $table->string('especializacao')->nullable();

      $table->unique(['nome','especializacao']);

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
    Schema::dropIfExists('perfis');
  }
}
