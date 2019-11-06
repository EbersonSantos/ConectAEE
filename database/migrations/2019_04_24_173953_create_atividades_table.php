<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('atividades', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('titulo');
      $table->text('descricao')->nullable();
      $table->string('prioridade');
      $table->string('status');
      $table->date('data');
      $table->boolean('concluido')->default(false);

      $table->integer('objetivo_id')->unsigned();
      $table->foreign('objetivo_id')->references('id')->on('objetivos')->onDelete('cascade');;

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
    Schema::dropIfExists('atividades');
  }
}
