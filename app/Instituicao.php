<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instituicao extends Model
{
  use SoftDeletes;
  
  public function endereco(){
      return $this->hasOne(Endereco::class,'id','endereco_id');
  }

  public function alunos(){
      return $this->belongsToMany(Aluno::class, 'aluno_instituicaos');
  }

  public function user(){
      return $this->belongsTo(User::class);
  }
}
