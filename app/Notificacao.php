<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
  public function destinatario(){
      return $this->belongsTo(User::class,'destinatario_id','id');
  }

  public function remetente(){
      return $this->belongsTo(User::class,'remetente_id','id');
  }

  public function aluno(){
      return $this->belongsTo(Aluno::class,'aluno_id','id');
  }

  public function perfil(){
      return $this->belongsTo(Perfil::class,'perfil_id','id');
  }

  public function objetivo(){
      return $this->belongsTo(Objetivo::class,'objetivo_id','id');
  }
}
