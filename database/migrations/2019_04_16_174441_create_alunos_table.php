<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('alunos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nome');
      $table->char('sexo',1);
      $table->date('data_de_nascimento');
      $table->string('cid')->nullable();
      $table->string('descricao_cid')->nullable();
      $table->text('observacao')->nullable();
      $table->string('cpf')->unique();
      $table->string('imagem')->nullable();

      $table->integer('endereco_id');
      $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');

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
    Schema::dropIfExists('alunos');
  }
}
