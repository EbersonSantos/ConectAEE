<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Atividade extends Model
{
  use SoftDeletes;

  public function getDataAttribute( $value ) {
    return (new Carbon($value))->format('d/m/Y');
  }

  public function objetivo(){
    return $this->belongsTo('App\Objetivo');
  }
}
