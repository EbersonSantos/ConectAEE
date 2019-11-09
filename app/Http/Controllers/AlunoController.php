<?php

namespace App\Http\Controllers;

use App\User;
use App\Instituicao;
use App\Notificacao;
use App\Aluno;
use App\Gerenciar;
use App\Perfil;
use App\Endereco;
use App\ForumAluno;
use App\MensagemForumAluno;
use File;
use Image;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlunoController extends Controller{

  public static function gerenciar($id_aluno){
    $aluno = Aluno::find($id_aluno);

    $mensagens = MensagemForumAluno::where('forum_aluno_id','=',$aluno->forum->id)
                                   // ->where('texto', 'not like', '%'.'<img'.'%')
                                   // ->where('texto', 'not like', '%'.'<iframe'.'%')
                                   // ->orderBy('id','desc')->take(5)->get();
                                   ->orderBy('id','desc')->get();

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

    return view("aluno.perfil",[
      'aluno' => $aluno,
      'mensagens' => $mensagens,
    ]);
  }

  public static function listar(){
    $gerenciars = \Auth::user()->gerenciars;
    $ids_alunos = array();

    foreach($gerenciars as $gerenciar){
      array_push($ids_alunos,$gerenciar->aluno_id);
    }

    $alunos = Aluno::whereIn('id', $ids_alunos)->orderBy('nome','asc')->paginate(18);

    return view("aluno.listar",[
      'alunos' => $alunos,
      'termo' => ""
    ]);
  }

  public static function buscarAluno(Request $request){

    $gerenciars = \Auth::user()->gerenciars;
    $ids_alunos = array();

    foreach($gerenciars as $gerenciar){
      array_push($ids_alunos,$gerenciar->aluno_id);
    }

    $alunos = Aluno::whereIn('id', $ids_alunos)->where('nome','ilike', '%'.$request->termo.'%')->paginate(12);

    return view("aluno.listar",[
      'alunos' => $alunos,
      'termo' => $request->termo
    ]);

  }

  public static function cadastrar(){
    $instituicoes = \Auth::user()->instituicoes;
    $perfis = [[1,'Responsável'], [2,'Professor AEE']];

    if (count($instituicoes) == 0) {
      return redirect()->route("instituicao.cadastrar")->with('info','O cadastro de alunos, requer que uma instituicão esteja cadastrada.');
    }

    return view("aluno.cadastrar", [
      'instituicoes' => $instituicoes,
      'perfis' => $perfis,
    ]);
  }

  public static function editar($id_aluno){

    $aluno = Aluno::find($id_aluno);
    $endereco = $aluno->endereco;
    $perfis = [[1,'Responsável'], [2,'Professor AEE']];
    $instituicoes = \Auth::user()->instituicoes;

    return view("aluno.editar", [
      'aluno' => $aluno,
      'endereco' =>$endereco,
      'instituicoes' => $instituicoes,
      'perfis' => $perfis
    ]);
  }

  public static function excluir($id_aluno){
    $aluno = Aluno::find($id_aluno);

    $gerenciars = Gerenciar::where('aluno_id','=',$aluno->id)->get();

    foreach($gerenciars as $gerenciar){
      $gerenciar->delete();
    }

    $aluno->delete();

    return redirect()->route("aluno.listar")->with('success','O aluno '.$aluno->nome.' foi excluído.');
  }

  public static function buscar(){

    if (count(Auth::user()->instituicoes) == 0) {
      return redirect()->route("instituicao.cadastrar")->with('info','O cadastro de alunos, requer que uma instituicão esteja cadastrada.');
    }

    return view("aluno.buscarCPF", [
      'cpf' => [],
      'aluno' => []
    ]);
  }

  public function buscarCPF(Request $request){

    $this->validate($request, [
      'cpf' => 'required|cpf|formato_cpf',
    ]);

    $cpf = $request->cpf;
    $aluno = Aluno::where('cpf','=', $cpf)->first();
    $botaoAtivo = false;

    if($aluno == null){
      return redirect()->route("aluno.cadastrar")->with('cpf', $cpf);
    }else{
      $gerenciars = $aluno->gerenciars;

      foreach ($gerenciars as $gerenciar) {
        if ($gerenciar->user->id == \Auth::user()->id && $gerenciar->isAdministrador) {
          $botaoAtivo = true;
        }
      }
    }

    return view("aluno.buscarCPF", [
      'aluno' => $aluno,
      'cpf' => $cpf,
      'botaoAtivo' => $botaoAtivo
    ]);

  }

  public static function criar(Request $request){
    $validator = Validator::make($request->all(), [
      'perfil' => ['required'],
      'instituicoes' => ['required'],
      'imagem' => 'image|mimes:jpeg,png,jpg,jpe|max:3000',
      'nome' => ['required','min:2','max:191'],
      'sexo' => ['required'],
      'cpf'=> ['unique:alunos'],
      'cid' => ['nullable','regex:/(^([a-zA-z])(\d)(\d)(\d)$)/u'],
      'descricaoCid' => ['required_with:cid'],
      'observacao' => ['nullable'],
      'data_nascimento' => ['required','date','before:today','after:01/01/1900'],
      'logradouro' => ['required'],
      'numero' => ['required','numeric'],
      'bairro' => ['required'],
      'cidade' => ['required'],
      'estado' => ['required'],
      'username' => ['required_if:perfil,==,2']
    ],[
      'username.required_if' => 'É necessário criar um usuário quando o cadastrante é um Professor AEE',
    ]);

    $validator->sometimes('username', 'unique:users', function ($request) {
      return $request->cadastrado == "false";
    });

    $validator->sometimes('username', 'exists:users', function ($request) {
      return $request->cadastrado == "true";
    });

    if(\Auth::user()->username == $request->username){
      $validator->errors()->add('username','Você não pode colocar seu nome de usuário neste campo.');
      return redirect()->back()->withErrors($validator->errors())->withInput()->with('cpf', $request->cpf);
    }

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput()->with('cpf', $request->cpf);
    }

    $endereco = new Endereco();
    $endereco->numero = $request->numero;
    $endereco->logradouro = $request->logradouro;
    $endereco->bairro = $request->bairro;
    $endereco->cidade = $request->cidade;
    $endereco->estado = $request->estado;
    $endereco->save();

    $aluno = new Aluno();

    if ($request->imagem != null) {
      $nome = uniqid(date('HisYmd'));
      $extensao = $request->imagem->extension();
      $nomeArquivo = "{$nome}.{$extensao}";
      $request->imagem->storeAs('public/avatars', $nomeArquivo);
      $aluno->imagem = $nomeArquivo;
    }

    $aluno->nome = $request->nome;
    $aluno->sexo = $request->sexo;
    $aluno->cid = $request->cid;
    $aluno->descricao_cid = $request->descricaoCid;
    $aluno->observacao = $request->observacao;
    $aluno->data_de_nascimento = $request->data_nascimento;
    $aluno->endereco_id = $endereco->id;
    $aluno->cpf = $request->cpf;
    $aluno->save();

    // do{
    //   $matricula = str_random(8);
    //   $alunoCPF = Aluno::where('matricula','=',$matricula)->first();
    // }while($alunoCPF != NULL);


    $aluno->instituicoes()->attach($request->instituicoes);

    $forum = new ForumAluno();
    $forum->aluno_id = $aluno->id;
    $forum->save();

    $gerenciar = new Gerenciar();
    $gerenciar->user_id = \Auth::user()->id;
    $gerenciar->aluno_id = $aluno->id;
    $gerenciar->perfil_id = $request->perfil;
    $gerenciar->isAdministrador = True;
    $gerenciar->save();

    // $password = str_random(6);
    $password = '12345678';

    $user = new User();

    if($request->perfil == 2 && $request->cadastrado == "false"){
      $user->username = $request->username;
      $user->password = bcrypt($password);
      $user->cadastrado = false;
      $user->save();
    }else if($request->perfil == 2 && $request->cadastrado == "true"){
      $user = User::where('username','=',$request->username)->first();
    }

    if ($request->perfil == 2) {
      $gerenciar = new Gerenciar();
      $gerenciar->user_id = $user->id;
      $gerenciar->aluno_id = $aluno->id;
      $gerenciar->perfil_id = 1;  //responsavel
      $gerenciar->isAdministrador = True;
      $gerenciar->save();
    }

    $notificacao = new Notificacao();
    $notificacao->aluno_id = $gerenciar->aluno_id;
    $notificacao->remetente_id = \Auth::user()->id;
    $notificacao->destinatario_id = $gerenciar->user_id;
    $notificacao->perfil_id = $gerenciar->perfil_id;
    $notificacao->lido = false;
    $notificacao->tipo = 2;
    $notificacao->save();

    if($request->perfil == 2 && $request->cadastrado == "false"){
      return redirect()->route("aluno.listar")->with('success','O Aluno '.$aluno->nome.' foi cadastrado.')->with('password', 'A senha provisória do usuário '.$request->username.' é '.$password.'.');
    }else{
      return redirect()->route("aluno.listar")->with('success','O Aluno '.$aluno->nome.' foi cadastrado.');
    }
  }

  public static function atualizar(Request $request){

    $validator = Validator::make($request->all(), [
      'instituicoes' => ['required'],
      'imagem' => 'image|mimes:jpeg,png,jpg,jpe|max:3000',
      'nome' => ['required','min:2','max:191'],
      'sexo' => ['required'],
      'cid' => ['nullable','regex:/(^([a-zA-z])(\d)(\d)(\d)$)/u'],
      'descricaoCid' => ['required_with:cid'],
      'observacao' => ['nullable'],
      'data_nascimento' => ['required','date','before:today','after:01/01/1900'],
      'logradouro' => ['required'],
      'numero' => ['required','numeric'],
      'bairro' => ['required'],
      'cidade' => ['required'],
      'estado' => ['required'],
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $endereco = Endereco::find($request->id_endereco);
    $endereco->logradouro = $request->logradouro;
    $endereco->numero = $request->numero;
    $endereco->bairro = $request->bairro;
    $endereco->cidade = $request->cidade;
    $endereco->estado = $request->estado;
    $endereco->update();

    $aluno = Aluno::find($request->id_aluno);

    if ($request->imagem != null) {
      $nome = uniqid(date('HisYmd'));
      $extensao = $request->imagem->extension();
      $nomeArquivo = "{$nome}.{$extensao}";
      $request->imagem->storeAs('public/avatars', $nomeArquivo);
      $aluno->imagem = $nomeArquivo;
    }

    $aluno->nome = $request->nome;
    $aluno->sexo = $request->sexo;
    $aluno->cid = $request->cid;
    $aluno->descricao_cid = $request->descricaoCid;
    $aluno->observacao = $request->observacao;
    $aluno->data_de_nascimento = $request->data_nascimento;
    $aluno->endereco_id = $endereco->id;

    $aluno->update();
    $aluno->instituicoes()->detach();
    $aluno->instituicoes()->attach($request->instituicoes);

    return redirect()->route("aluno.gerenciar", ['id_aluno' => $request->id_aluno])->with('success','O Aluno '.$aluno->nome.' foi atualizado.');
  }

  public static function requisitarPermissao($cpf){
    $aluno = Aluno::where('cpf','=',$cpf)->first();

    $perfis = Perfil::where('especializacao','=',NULL)->get();

    $especializacoes = Perfil::select('especializacao')
    ->where('especializacao', '!=', NULL)
    ->get()->toArray();

    $especializacoes = array_column($especializacoes, 'especializacao');

    return view('permissoes.requisitar',[
      'aluno' => $aluno,
      'perfis' => $perfis,
      'especializacoes' => $especializacoes,
    ]);
  }

  public static function notificarPermissao(Request $request){

    $rules = array(
      'perfil' => 'required',
      'especializacao' => 'required_if:perfil,Profissional Externo',
    );
    $messages = array(
      'perfil.required' => 'Selecione um perfil.',
      'especializacao.required_if' => 'Necessário inserir uma especialização.',
    );

    $validator = Validator::make($request->all(),$rules,$messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $aluno = Aluno::find($request->id_aluno);
    $gerenciars = $aluno->gerenciars;

    $perfil = Perfil::where('nome','=',$request->perfil)->where('especializacao','=',$request->especializacao)->first();

    if($perfil == NULL ){
      if($request->perfil == 'Profissional Externo'){
        $perfil = new Perfil();
        $perfil->nome = 'Profissional Externo';
        $perfil->especializacao = $request->especializacao;
        $perfil->save();
      }else{
        $perfil = Perfil::where('nome','=',$request->perfil)->where('especializacao','=',NULL)->first();
      }
    }

    foreach ($gerenciars as $gerenciar) {
      if ($gerenciar->isAdministrador) {
        $notificacao = new Notificacao();
        $notificacao->aluno_id = $aluno->id;
        $notificacao->remetente_id = \Auth::user()->id;
        $notificacao->destinatario_id = $gerenciar->user_id;
        $notificacao->perfil_id = $perfil->id;
        $notificacao->lido = false;
        $notificacao->tipo = 1;
        $notificacao->save();
      }
    }

    return redirect()->route("aluno.listar")->with('success','Seu pedido de acesso à '.$aluno->nome.' foi enviado. Aguarde aceitação.');
  }

  public static function gerenciarPermissoes($id_aluno){
    $aluno = Aluno::find($id_aluno);
    $gerenciars = $aluno->gerenciars;

    return view('permissoes.listar',[
      'aluno' => $aluno,
      'gerenciars' => $gerenciars,
    ]);
  }

  public static function cadastrarPermissao($id_aluno){
    $aluno = Aluno::find($id_aluno);
    $perfis = Perfil::where('especializacao','=',NULL)->get();

    $especializacoes = Perfil::select('especializacao')
    ->where('especializacao', '!=', NULL)
    ->get()->toArray();

    $especializacoes = array_column($especializacoes, 'especializacao');

    return view('permissoes.cadastrar',[
      'aluno' => $aluno,
      'perfis' => $perfis,
      'especializacoes' => $especializacoes,
    ]);
  }

  public static function concederPermissao($id_notificacao){
    $notificacao = Notificacao::find($id_notificacao);
    $aluno = $notificacao->aluno;

    return view('permissoes.conceder',[
      'aluno' => $aluno,
      'notificacao' => $notificacao,
    ]);
  }

  public static function criarPermissao(Request $request){
    //Validação dos dados
    $rules = array(
      'username' => 'required|exists:users,username',
      'perfil' => 'required',
      'especializacao' => 'required_if:perfil,Profissional Externo',
    );
    $messages = array(
      'username.required' => 'Necessário inserir um nome de usuário.',
      'username.exists' => 'O usuário em questão não está cadastrado.',
      'perfil.required' => 'Selecione um perfil.',
      'especializacao.required_if' => 'Necessário inserir uma especialização.',
    );
    $validator = Validator::make($request->all(),$rules,$messages);
    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    //Se já existe a relação
    $user = User::where('username','=',$request->username)->first();
    if((Gerenciar::where('user_id','=',$user->id)->where('aluno_id','=',$request->id_aluno))->first()){
      $validator->errors()->add('username','O usuário já possui permissões de acesso ao aluno.');
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }
    // $gerenciar = Gerenciar::where('aluno_id','=',$request->aluno)->where('user_id','=',$user->id)->first();
    // if($gerenciar != NULL){
    //   return redirect()->back()->withInput()->with('Fail','O usuário '.$user->name.' já possui permissões.');
    // }

    //Criação do Gerencimento
    $gerenciar = new Gerenciar();
    $gerenciar->user_id = $user->id;
    $gerenciar->aluno_id = (int) $request->id_aluno;

    $perfil = Perfil::where('nome','=',$request->perfil)->where('especializacao','=',$request->especializacao)->first();

    if($perfil == NULL ){
      if($request->perfil == 'Profissional Externo'){
        $perfil = new Perfil();
        $perfil->nome = 'Profissional Externo';
        $perfil->especializacao = $request->especializacao;
        $perfil->save();
      }else{
        $perfil = Perfil::where('nome','=',$request->perfil)->where('especializacao','=',NULL)->first();
      }
    }

    $gerenciar->perfil_id = $perfil->id;
    if($request->exists('isAdministrador') || $request->perfil == 'Responsável'){
      $gerenciar->isAdministrador = $request->isAdministrador;
    }
    //dd($gerenciar);
    $gerenciar->save();

    $notificacao = new Notificacao();
    $notificacao->aluno_id = $gerenciar->aluno_id;
    $notificacao->remetente_id = \Auth::user()->id;
    $notificacao->destinatario_id = $gerenciar->user_id;
    $notificacao->perfil_id = $gerenciar->perfil_id;
    $notificacao->lido = false;
    $notificacao->tipo = 2;
    $notificacao->save();

    return redirect()->route('aluno.permissoes',['id_aluno' => $gerenciar->aluno_id])->with('Success','O usuário '.$user->name.' agora possui permissão de acesso ao aluno.');
  }

  public static function atualizarPermissao(Request $request){
    //Validação dos dados
    $rules = array(
      'perfil' => 'required',
      'especializacao' => 'required_if:perfil,Profissional Externo',
    );
    $messages = array(
      'username.exists' => 'O usuário em questão não está cadastrado.',
      'perfil.required' => 'Selecione um perfil.',
      'especializacao.required_if' => 'Necessário inserir uma especialização.',
    );

    $validator = Validator::make($request->all(),$rules,$messages);
    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    //Criação do Gerencimento
    $gerenciar = Gerenciar::find($request->id_permissao);

    $perfil = Perfil::where('nome','=',$request->perfil)->where('especializacao','=',$request->especializacao)->first();

    if($perfil == NULL ){
      if($request->perfil == 'Profissional Externo'){
        $perfil = new Perfil();
        $perfil->nome = 'Profissional Externo';
        $perfil->especializacao = $request->especializacao;
        $perfil->save();
      }else{
        $perfil = Perfil::where('nome','=',$request->perfil)->where('especializacao','=',NULL)->first();
      }
    }

    $gerenciar->perfil_id = $perfil->id;

    if($request->exists('isAdministrador') || $request->perfil == 'Responsável'){
      $gerenciar->isAdministrador = true;
    }

    $gerenciar->update();

    $user = $gerenciar->user;

    // $notificacao = new Notificacao();
    // $notificacao->aluno_id = $gerenciar->aluno_id;
    // $notificacao->remetente_id = \Auth::user()->id;
    // $notificacao->destinatario_id = $gerenciar->user_id;
    // $notificacao->perfil_id = $gerenciar->perfil_id;
    // $notificacao->lido = false;
    // $notificacao->tipo = 2;
    // $notificacao->save();

    return redirect()->route('aluno.permissoes',['id_aluno' => $gerenciar->aluno_id])->with('Success','A permissão de acesso do usuário '.$user->name.' foi alterada.');
  }


  public function editarPermissao($id_permissao){
    $perfis = Perfil::where('especializacao','=',NULL)->get();

    $especializacoes = Perfil::select('especializacao')
    ->where('especializacao', '!=', NULL)
    ->get()->toArray();

    $especializacoes = array_column($especializacoes, 'especializacao');

    $gerenciar = Gerenciar::find($id_permissao);
    $aluno = $gerenciar->aluno;

    return view('permissoes.editar',[
      'aluno' => $aluno,
      'perfis' => $perfis,
      'gerenciar' => $gerenciar,
      'especializacoes' => $especializacoes,
    ]);

    // return redirect()->back()->with('Removed','Permissões removidas com sucesso.');
  }

  public function removerPermissao($id_permissao){
    $gerenciar = Gerenciar::find($id_permissao);
    $gerenciar->delete();

    return redirect()->back()->with('Removed','Permissões removidas com sucesso.');
  }
}
