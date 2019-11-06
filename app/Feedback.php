<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sugestao;
use App\User;

class Feedback extends Model
{
    public function sugestao(){
        return $this->belongsTo(Sugestao::class,'sugestao_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
