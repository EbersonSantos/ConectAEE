<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Objetivo;
use App\Aluno;
use App\Notificacao;
use App\Atividade;
use DateTime;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AtividadeController extends Controller
{
  public static function cadastrar($id_objetivo){
    $statuses = ["Não iniciada", "Em andamento", "Finalizada"];
    $prioridades = ["Alta","Média","Baixa"];
    $objetivo = Objetivo::find($id_objetivo);
    $aluno = $objetivo->aluno;

    return view("atividade.cadastrar", [
      'aluno' => $aluno,
      'objetivo' => $objetivo,
      'statuses' => $statuses,
      'prioridades' => $prioridades
    ]);
  }

  public static function editar($id_atividade){
    $atividade = Atividade::find($id_atividade);
    $objetivo = $atividade->objetivo;
    $aluno = $atividade->objetivo->aluno;

    $statuses = ["Não iniciada", "Em andamento", "Finalizada"];
    $prioridades = ["Alta","Média","Baixa"];

    return view("atividade.editar", [
      'aluno' => $aluno,
      'objetivo' => $objetivo,
      'atividade' => $atividade,
      'statuses' => $statuses,
      'prioridades' => $prioridades
    ]);
  }

  public static function excluir($id_atividade){
    $atividade = Atividade::find($id_atividade);
    $objetivo = $atividade->objetivo;
    $atividade->delete();

    return redirect()->route("objetivo.gerenciar", ["id_objetivo" => $atividade->objetivo->id])->with('success','A atividade '.$atividade->titulo.' foi excluída.');;
  }

  public static function criar(Request $request){
    $validator = Validator::make($request->all(), [
      'titulo' => ['required','min:2','max:100'],
      'descricao' => ['max:500'],
      'prioridade' => ['required'],
      'status' => ['required'],
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $statuses = ["Não iniciada", "Em andamento", "Finalizada"];

    $atividade = new Atividade();
    $atividade->titulo = $request->titulo;
    $atividade->descricao = $request->descricao;
    $atividade->prioridade = $request->prioridade;
    $atividade->status = $statuses[$request->status];
    $atividade->data = new DateTime();
    $atividade->objetivo_id = $request->id_objetivo;
    $atividade->save();

    AtividadeController::notificarAtividade($atividade);

    return Redirect::to(route("objetivo.gerenciar", ["id_objetivo" => $atividade->objetivo->id]) . "#atividades")->with('atividade','A atividade '.$atividade->titulo.' foi cadastrada.');
  }

  public static function atualizar(Request $request){
    $validator = Validator::make($request->all(), [
      'titulo' => ['required','min:2','max:100'],
      'descricao' => ['max:500'],
      'prioridade' => ['required'],
      'status' => ['required'],
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $statuses = ["Não iniciada", "Em andamento", "Finalizada"];

    $atividade = Atividade::find($request->id_atividade);
    $atividade->titulo = $request->titulo;
    $atividade->descricao = $request->descricao;
    $atividade->prioridade = $request->prioridade;
    $atividade->status = $statuses[$request->status];
    $atividade->update();

    return Redirect::to(route("objetivo.gerenciar", ["id_objetivo" => $atividade->objetivo->id]) . "#atividades")->with('atividade','A atividade '.$atividade->titulo.' foi atualizada.');;
  }

  public static function concluir($id_atividade){

    $atividade = Atividade::find($id_atividade);
    $objetivo = $atividade->objetivo;
    $atividade->concluido = True;
    $atividade->status = "Finalizada";
    $atividade->update();

    return Redirect::to(route("objetivo.gerenciar", ["id_objetivo" => $atividade->objetivo->id]) . "#atividades")->with('atividade','A atividade '.$atividade->titulo.' foi concluída.');;

  }

  public static function desconcluir($id_atividade){


    $atividade = Atividade::find($id_atividade);
    $objetivo = $atividade->objetivo;
    $atividade->concluido = False;
    $atividade->status = "Em andamento";
    $atividade->update();

    return Redirect::to(route("objetivo.gerenciar", ["id_objetivo" => $atividade->objetivo->id]) . "#atividades")->with('atividade','A atividade '.$atividade->titulo.' foi reaberta.');;

  }

  public static function corStatus($status){
    switch ($status) {
      case 'Não iniciada':
        return '#661414';
        break;
      case 'Em andamento':
        return '#DDA600';
        break;
      case 'Finalizada':
        return '#12583C';
        break;
    }
  }

  private static function notificarAtividade($atividade){

    $id_objetivo = $atividade->objetivo->id;
    $id_aluno =$atividade->objetivo->aluno->id;

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
        $notificacao->tipo = 4; //atividade
        $notificacao->save();
      }
    }
  }

}
