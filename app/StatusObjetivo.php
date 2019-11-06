<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StatusObjetivo extends Model
{

  public function getDataAttribute( $value ) {

    return (new Carbon($value))->format('d/m/Y');
  }

  public function objetivo()
  {
      return $this->belongsTo('App\Objetivo');
  }

  public function status()
  {
      return $this->hasOne('App\Status','id','status_id');
  }

}
