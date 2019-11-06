<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Objetivo extends Model
{
  use SoftDeletes;

  public function getDataAttribute( $value ) {
    return (new Carbon($value))->format('d/m/Y');
  }

  public function atividades()
  {
      return $this->hasMany('App\Atividade');
  }

  public function sugestoes()
  {
      return $this->hasMany('App\Sugestao');
  }

  public function aluno()
  {
      return $this->belongsTo('App\Aluno');
  }

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function forum()
  {
    return $this->hasOne(ForumObjetivo::class);
  }

  public function cor()
  {
    return $this->hasOne(Cor::class, 'id', 'cor_id');
  }

  public function tipoObjetivo()
  {
      return $this->hasOne('App\TipoObjetivo','id','tipo_objetivo_id');
  }

  public function statusObjetivo()
  {
      return $this->hasMany('App\StatusObjetivo');
  }

}
