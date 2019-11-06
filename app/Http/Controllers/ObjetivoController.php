<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Objetivo;
use App\Gerenciar;
use App\ForumObjetivo;
use App\TipoObjetivo;
use App\StatusObjetivo;
use App\Aluno;
use App\Notificacao;
use App\Cor;
use App\Status;
use App\MensagemForumObjetivo;
use DateTime;
use Auth;

class ObjetivoController extends Controller
{
  public static function cadastrar($id_aluno){
    $tipos = TipoObjetivo::all();

    $prioridades = ["Alta","Média","Baixa"];
    $aluno = Aluno::find($id_aluno);

    return view("objetivo.cadastrar", [
      'aluno' => $aluno,
      'tipos' => $tipos,
      'prioridades' => $prioridades
    ]);
  }

  public static function buscar(Request $request){

    $aluno = Aluno::find($request->id_aluno);

    $objetivos = Objetivo::where(function ($query) use ($request){
                     $query->where('aluno_id','=',$request->id_aluno)
                           ->where('titulo','ilike', '%'.$request->termo.'%');
                 })->orWhere(function ($query) use ($request){
                     $query->where('aluno_id','=',$request->id_aluno)
                           ->where('descricao','ilike','%'.$request->termo.'%');
                 })->get();

    $objetivosGroupByUser = $objetivos->groupBy('user_id');

    $size = 0;

    if (count($objetivosGroupByUser) != 0) {
      $size = count(max($objetivosGroupByUser->toArray()));
    }

    return view("objetivo.listar", [
      'aluno' => $aluno,
      'objetivosGroupByUser' => $objetivosGroupByUser,
      'size' => $size,
      'termo' => $request->termo
    ]);

  }

  public static function listar($id_aluno){

    $aluno = Aluno::find($id_aluno);
    $objetivosGroupByUser = $aluno->objetivos->groupBy('user_id');

    $size = 0;

    if (count($objetivosGroupByUser) != 0) {
      $size = count(max($objetivosGroupByUser->toArray()));
    }

    return view("objetivo.listar", [
      'aluno' => $aluno,
      'objetivosGroupByUser' => $objetivosGroupByUser,
      'size' => $size,
      'termo' => ""
    ]);
  }

  public static function editar($id_objetivo){
    $tipos = TipoObjetivo::all();

    $prioridades = ["Alta","Média","Baixa"];
    $objetivo = Objetivo::find($id_objetivo);
    $aluno = $objetivo->aluno;

    return view("objetivo.editar", [
      'aluno' => $aluno,
      'objetivo' => $objetivo,
      'tipos' => $tipos,
      'prioridades' => $prioridades
    ]);
  }

  public static function excluir($id_objetivo){
    $objetivo = Objetivo::find($id_objetivo);
    $objetivo->delete();

    return redirect()->route("objetivo.listar", ["id_aluno" => $objetivo->aluno->id])->with('success','O objetivo '.$objetivo->titulo.' foi excluído.');;
  }

  public static function criar(Request $request){
    $validator = Validator::make($request->all(), [
      'titulo' => ['required','min:2','max:100'],
      'descricao' => ['required'],
      'prioridade' => ['required'],
      'tipo' => ['required'],
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $objetivosUser = Objetivo::where('user_id','=',Auth::user()->id)->where('aluno_id','=',$request->id_aluno)->get();

    $objetivo = new Objetivo();
    $objetivo->titulo = $request->titulo;
    $objetivo->descricao = $request->descricao;
    $objetivo->prioridade = $request->prioridade;
    $objetivo->data = new DateTime();
    $objetivo->aluno_id = $request->id_aluno;
    $objetivo->user_id = Auth::user()->id;
    $objetivo->tipo_objetivo_id = $request->tipo;
    $objetivo->save();

    $aluno = $objetivo->aluno;
    $objetivosGroupByUser = $aluno->objetivos->groupBy('user_id');
    $n_users = count($objetivosGroupByUser);

    $cores = Cor::take($n_users)->get();

    if(count($objetivosUser) == 0){
      $objetivo->cor_id = $cores[$n_users-1]->id;
      $objetivo->update();
    }else{
      $objetivo->cor_id = $objetivosGroupByUser[Auth::user()->id][1]->cor->id;
      $objetivo->update();
    }

    $statusObjetivo = new StatusObjetivo();
    $statusObjetivo->data = new DateTime();
    $statusObjetivo->objetivo_id = $objetivo->id;
    $statusObjetivo->status_id = 1;
    $statusObjetivo->save();

    $forum = new ForumObjetivo();
    $forum->objetivo_id = $objetivo->id;
    $forum->save();

    ObjetivoController::notificarObjetivo($request->id_aluno, $objetivo->id);

    return redirect()->route("objetivo.listar", ["id_aluno" => $request->id_aluno])->with('success','Objetivo cadastrado.');
  }

  public static function atualizar(Request $request){
    $validator = Validator::make($request->all(), [
      'titulo' => ['required','min:2','max:100'],
      'descricao' => ['required'],
      'prioridade' => ['required'],
      'tipo' => ['required'],
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $objetivo = Objetivo::find($request->id_objetivo);
    $objetivo->titulo = $request->titulo;
    $objetivo->descricao = $request->descricao;
    $objetivo->prioridade = $request->prioridade;
    $objetivo->tipo_objetivo_id = $request->tipo;
    $objetivo->update();

    $aluno = Aluno::find($request->id_aluno);

    return redirect()->route('objetivo.gerenciar',[$objetivo->id] )->with('success','O objetivo '.$objetivo->titulo.' foi atualizado.');;
  }

  public static function gerenciar($id_objetivo){

    $objetivo = Objetivo::find($id_objetivo);
    $atividades = $objetivo->atividades;
    $sugestoes = $objetivo->sugestoes;
    $aluno = $objetivo->aluno;

    // $atividadesGroupByData = $objetivo->atividades->groupBy('data');
    // $sugestoesGroupByData = $objetivo->sugestoes->groupBy('data');
    $mensagens = MensagemForumObjetivo::where('forum_objetivo_id','=',$objetivo->forum->id)->orderBy('id','desc')->take(5)->get();

    foreach ($mensagens as $mensagem) {
      $img = strpos($mensagem->texto, '<img');
      $video = strpos($mensagem->texto, '<iframe');

      if($img){
        $mensagem->texto = str_replace('<img', '<img style="width:100%"', $mensagem->texto);
      }

      if($video){
        $mensagem->texto = str_replace('<iframe', '<iframe style="width:100%"', $mensagem->texto);
      }
    }

    // $size1 = 0;
    // $size2 = 0;
    //
    // if (count($atividadesGroupByData) != 0) {
    //   $size1 = count(max($atividadesGroupByData->toArray()));
    // }
    //
    // if (count($sugestoesGroupByData) != 0) {
    //   $size2 = count(max($sugestoesGroupByData->toArray()));
    // }

    $statuses = ["Não iniciada", "Em andamento", "Finalizada"];
    $statusesObjetivo = Status::all();

    return view("objetivo.gerenciar",[
      'aluno' => $aluno,
      'objetivo' => $objetivo,
      'atividades' => $atividades,
      'sugestoes' => $sugestoes,
      // 'atividadesGroupByData' => $atividadesGroupByData,
      // 'sugestoesGroupByData' => $sugestoesGroupByData,
      'mensagens'=> $mensagens,
      // 'size1' => $size1,
      // 'size2' => $size2,
      'statuses' => $statuses,
      'statusesObjetivo' => $statusesObjetivo,
    ]);
  }

  public function concluir($id_objetivo){

    $objetivo = Objetivo::find($id_objetivo);

    $objetivo->concluido = True;
    $objetivo->update();

    return redirect()->route("objetivo.gerenciar", ["id_objetivo" => $id_objetivo])->with('success','O objetivo foi concluído.');

  }

  public function desconcluir($id_objetivo){

    $objetivo = Objetivo::find($id_objetivo);

    $objetivo->concluido = False;
    $objetivo->update();

    return redirect()->route("objetivo.gerenciar", ["id_objetivo" => $id_objetivo])->with('success','O objetivo foi reaberto.');

  }

  private static function notificarObjetivo($id_aluno, $id_objetivo){

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
        $notificacao->tipo = 3; //onjetivo
        $notificacao->save();
      }
    }
  }

}
