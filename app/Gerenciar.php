<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gerenciar extends Model
{
    public function aluno(){
        return $this->hasOne(Aluno::class,'id','aluno_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function perfil(){
        return $this->hasOne(Perfil::class,'id','perfil_id');
    }
}
