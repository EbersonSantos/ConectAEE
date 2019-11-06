<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumObjetivo extends Model
{
    public function objetivo(){
        return $this->belongsTo('App\Objetivo');
    }
}
