<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Objetivo;
use App\Aluno;
use App\Sugestao;
use DateTime;

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

    return redirect()->route("sugestao.ver", ["id_sugestao" => $sugestao->id])->with('success','Sugestão cadastrada.');
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

    return redirect()->route("sugestao.ver", ["id_sugestao" => $sugestao->id])->with('success','A sugestão '.$sugestao->titulo.' foi atualizada.');
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

}
