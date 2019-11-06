<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Sugestao extends Model
{
  use softDeletes;

  public function getDataAttribute( $value ) {
    return (new Carbon($value))->format('d/m/Y');
  }

  public function objetivo(){
    return $this->belongsTo('App\Objetivo');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function feedbacks(){
    return $this->hasMany('App\Feedback')->orderBy('created_at','asc');
  }
}
