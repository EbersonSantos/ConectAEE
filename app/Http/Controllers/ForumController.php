<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MensagemForumAluno;
use App\MensagemForumObjetivo;
use Illuminate\Support\Facades\Validator;
use App\Aluno;
use App\Objetivo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


class ForumController extends Controller
{
  public function enviarMensagemForumAluno(Request $request){
    //dd($request->all());

    $rules = array(
      'mensagem' => 'required',
    );
    $messages = array(
      'mensagem.required' => 'O campo de mensagem não pode estar vazio.',
    );
    $validator = Validator::make($request->all(),$rules,$messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $mensagem = new MensagemForumAluno();
    $mensagem->texto = $request->mensagem;
    $mensagem->user_id = \Auth::user()->id;
    $mensagem->forum_aluno_id = $request->forum_id;
    $mensagem->save();

    return Redirect::to(URL::previous() . "#forum")->with('display',true);
  }

  public function abrirForumAluno($id_aluno){
    $aluno = Aluno::find($id_aluno);

    $mensagens = MensagemForumAluno::where('forum_aluno_id','=',$aluno->forum->id)->orderBy('id','desc')->get();

    return view("forum.aluno.mensagens",[
      'aluno' => $aluno,
      'mensagens' => $mensagens,
    ]);
  }

  public function enviarMensagemForumObjetivo(Request $request){
    //dd($request->all());

    $rules = array(
      'mensagem' => 'required',
    );
    $messages = array(
      'mensagem.required' => 'O campo de mensagem não pode estar vazio.',
    );
    $validator = Validator::make($request->all(),$rules,$messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $mensagem = new MensagemForumObjetivo();
    $mensagem->texto = $request->mensagem;
    $mensagem->user_id = \Auth::user()->id;
    $mensagem->forum_objetivo_id = $request->forum_id;
    $mensagem->save();

    return Redirect::to(URL::previous() . "#forum");
  }

  public function abrirForumObjetivo($id_objetivo){
    $objetivo = Objetivo::find($id_objetivo);

    $mensagens = MensagemForumObjetivo::where('forum_objetivo_id','=',$objetivo->forum->id)->orderBy('id','desc')->get();

    return view("forum.objetivo.mensagens",[
      'objetivo' => $objetivo,
      'mensagens' => $mensagens,
    ]);
  }
}
