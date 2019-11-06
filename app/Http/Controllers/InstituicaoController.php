<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Aluno;
use App\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstituicaoController extends Controller
{
  public static function cadastrar(){
    return view("instituicao.cadastrar");
  }

  public static function buscar(Request $request){

    $instituicoes = Instituicao::where(function ($query) use ($request){
                                     $query->where('user_id','=',\Auth::user()->id);
                                 })->where(function ($query) use ($request){
                                     $query->orwhere('nome','ilike', '%'.$request->termo.'%')
                                           ->orWhereHas('endereco', function ($query) use ($request) {
                                              $query->where('logradouro', 'ilike', '%'.$request->termo.'%');
                                           })
                                           ->orWhereHas('endereco', function ($query) use ($request) {
                                              $query->where('cidade', 'ilike', '%'.$request->termo.'%');
                                           })
                                           ->orWhereHas('endereco', function ($query) use ($request) {
                                              $query->where('bairro', 'ilike', '%'.$request->termo.'%');
                                           })
                                           ->orWhereHas('endereco', function ($query) use ($request) {
                                              $query->where('estado', 'ilike', '%'.$request->termo.'%');
                                           });
                                  })->get();

    return view("instituicao.listar",[
      'instituicoes' => $instituicoes,
      'termo' => $request->termo
    ]);

  }

  public static function ver($id_instituicao){
    $instituicao = Instituicao::find($id_instituicao);
    $endereco = Endereco::find($instituicao->endereco->id);

    return view("instituicao.ver", [
      'instituicao' => $instituicao,
      'endereco' => $endereco
    ]);
  }

  public static function editar($id_instituicao){
    $instituicao = Instituicao::find($id_instituicao);
    $endereco = Endereco::find($instituicao->endereco->id);

    return view("instituicao.editar", [
      'instituicao' => $instituicao,
      'endereco' => $endereco]);
    }

    public static function listar(){
      $instituicoes = \Auth::user()->instituicoes;

      return view("instituicao.listar", [
        'instituicoes' => $instituicoes,
        'termo' => "",
      ]);
    }

    public static function criar(Request $request){

      $validator = Validator::make($request->all(), [
        'nome' => ['required','min:2','max:191'],
        'email' => ['nullable', 'string', 'email', 'max:255'],
        'telefone' => ['required','numeric'],
        'logradouro' => ['required'],
        'numero' => ['required','numeric'],
        'bairro' => ['required'],
        'estado' => ['required'],
        'cidade' => ['required'],
      ]);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }

      $endereco = new Endereco();
      $endereco->logradouro = $request->logradouro;
      $endereco->numero = $request->numero;
      $endereco->bairro = $request->bairro;
      $endereco->cidade = $request->cidade;
      $endereco->estado = $request->estado;
      $endereco->save();

      $instituicao = new Instituicao();
      $instituicao->nome = $request->nome;
      $instituicao->telefone = $request->telefone;
      $instituicao->email = $request->email;
      $instituicao->endereco_id = $endereco->id;
      $instituicao->user_id = \Auth::user()->id;
      $instituicao->save();

      if(preg_match('/aluno\/cadastrar/', $request->rota)){
        return redirect()->route("aluno.cadastrar");
      }else{
        return redirect()->route("instituicao.listar")->with('success','A instituição '.$instituicao->nome.' foi cadastrada.');;
      }
    }

    public static function excluir($id_instituicao){
      $instituicao = Instituicao::find($id_instituicao);
      $instituicao->delete();

      return redirect()->route("instituicao.listar")->with('success','A instituição '.$instituicao->nome.' foi excluída.');;
    }

    public static function atualizar(Request $request){

      $validator = Validator::make($request->all(), [
        'nome' => ['required','min:2','max:191'],
        'email' => ['nullable', 'string', 'email', 'max:255'],
        'telefone' => ['required','numeric'],
        'logradouro' => ['required'],
        'numero' => ['required','numeric'],
        'bairro' => ['required'],
        'estado' => ['required'],
        'cidade' => ['required'],
      ]);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }

      $instituicao = Instituicao::find($request->id_instituicao);
      $instituicao->nome = $request->nome;
      $instituicao->telefone = $request->telefone;
      $instituicao->email = $request->email;
      $instituicao->update();

      $endereco = Endereco::find($request->id_endereco);
      $endereco->logradouro = $request->logradouro;
      $endereco->numero = $request->numero;
      $endereco->bairro = $request->bairro;
      $endereco->cidade = $request->cidade;
      $endereco->estado = $request->estado;
      $endereco->update();

      return redirect()->route("instituicao.listar")->with('success','A instituição '.$instituicao->nome.' foi atualizada.');;
    }
  }
