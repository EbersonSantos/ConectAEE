<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Objetivo;
use App\Aluno;
use App\Notificacao;
use App\Sugestao;
use DateTime;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class SugestaoController extends Controller
{
  public function cadastrar($id_objetivo){
    $objetivo = Objetivo::find($id_objetivo);
    $aluno = $objetivo->aluno;

    return view("sugestao.cadastrar", [
      'aluno' => $aluno,
      'objetivo' => $objetivo,
    ]);
  }

  public static function editar($id_sugestao){
    $sugestao = Sugestao::find($id_sugestao);
    $objetivo = $sugestao->objetivo;
    $aluno = $sugestao->objetivo->aluno;

    return view("sugestao.editar", [
      'aluno' => $aluno,
      'objetivo' => $objetivo,
      'sugestao' => $sugestao,
    ]);
  }

  public static function excluir($id_sugestao){
    $sugestao = Sugestao::find($id_sugestao);
    $objetivo = $sugestao->objetivo;
    $sugestao->delete();

    return redirect()->route("objetivo.gerenciar", ["id_objetivo" => $objetivo->id])->with('success','A sugestão '.$sugestao->titulo.' foi excluída.');;
  }

  public static function ver($id_sugestao){
    $sugestao = Sugestao::find($id_sugestao);
    $objetivo = $sugestao->objetivo;
    $aluno = $sugestao->objetivo->aluno;
    $feedbacks = $sugestao->feedbacks;

    foreach ($feedbacks as $feedback) {
      $img = strpos($feedback->texto, '<img');
      $video = strpos($feedback->texto, '<iframe');

      if($img){
        $feedback->texto = str_replace('<img', '<img style="width:100%"', $feedback->texto);
      }

      if($video){
        $feedback->texto = str_replace('<iframe', '<iframe style="width:100%"', $feedback->texto);
      }
    }

    return view("sugestao.ver", [
      'aluno' => $aluno,
      'objetivo' => $objetivo,
      'sugestao' => $sugestao,
      'feedbacks' => $feedbacks,
    ]);
  }

  public function criar(Request $request){
    $validator = Validator::make($request->all(), [
      'titulo' => ['required','min:2','max:100'],
      'descricao' => ['max:500'],
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $sugestao = new Sugestao();
    $sugestao->titulo = $request->titulo;
    $sugestao->descricao = $request->descricao;
    $sugestao->data = new DateTime();
    $sugestao->objetivo_id = $request->id_objetivo;
    $sugestao->user_id = \Auth::user()->id;
    $sugestao->save();

    SugestaoController::notificarSugestao($sugestao);

    return Redirect::to(route("objetivo.gerenciar", ["id_objetivo" => $sugestao->objetivo->id]) . "#sugestoes")->with('sugestao','Sugestão cadastrada.');;

  }

  public static function atualizar(Request $request){
    $validator = Validator::make($request->all(), [
      'titulo' => ['required','min:2','max:100'],
      'descricao' => ['max:500'],
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $sugestao = Sugestao::find($request->id_sugestao);
    $sugestao->titulo = $request->titulo;
    $sugestao->descricao = $request->descricao;
    $sugestao->update();

    return Redirect::to(route("objetivo.gerenciar", ["id_objetivo" => $sugestao->objetivo->id]) . "#sugestoes")->with('sugestao','Sugestão atualizada.');;

  }

  // public function listar($id_objetivo){
  //
  //   $objetivo = Objetivo::find($id_objetivo);
  //   $aluno = $objetivo->aluno;
  //   $sugestoes = $objetivo->sugestoes;
  //
  //   return view("sugestao.ver", [
  //     'aluno' => $aluno,
  //     'objetivo' => $objetivo,
  //     'sugestoes' => $sugestoes
  //   ]);
  // }

  private static function notificarSugestao($sugestao){

    $id_objetivo = $sugestao->objetivo->id;
    $id_aluno =$sugestao->objetivo->aluno->id;

    $aluno = Aluno::find($id_aluno);
    $gerenciars = $aluno->gerenciars;

    foreach ($gerenciars as $gerenciar) {
      if ($gerenciar->user != Auth::user()) {
        $notificacao = new Notificacao();
        $notificacao->aluno_id = $aluno->id;
        $notificacao->remetente_id = Auth::user()->id;
        $notificacao->destinatario_id = $gerenciar->user_id;
        $notificacao->objetivo_id = $id_objetivo;
        $notificacao->lido = false;
        $notificacao->tipo = 5; //sugestao
        $notificacao->save();
      }
    }
  }

}
