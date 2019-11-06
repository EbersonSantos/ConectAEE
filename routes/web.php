<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('layouts.principal');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

//Rotas para notificacões
Route::get('/usuario/notificacao/listar', 'NotificacaoController@listar')->name('notificacao.listar')->middleware('checkCadastrado');
Route::get('/usuario/notificacao/{id_notificacao}/ler', 'NotificacaoController@ler')->name('notificacao.ler')->middleware('checkNotificacao');

//Rotas para usuarios
Route::get('/usuario/completarCadastro', 'UsuarioController@completarCadastro')->name('usuario.completarCadastro')->middleware('checkNaoCadastrado');
Route::post('/usuario/completar', 'UsuarioController@completar')->name('usuario.completar');
Route::get('/usuario/editar', 'UsuarioController@editar')->name('usuario.editar')->middleware('checkCadastrado');
Route::post('/usuario/atualizar', 'UsuarioController@atualizar')->name('usuario.atualizar');
Route::get('/usuario/editarSenha', 'UsuarioController@editarSenha')->name('usuario.editarSenha')->middleware('checkCadastrado');
Route::post('/usuario/atualizarSenha', 'UsuarioController@atualizarSenha')->name('usuario.atualizarSenha');

//Rotas para alunos
Route::get('/aluno/cadastrar/', 'AlunoController@cadastrar')->name('aluno.cadastrar')->middleware('checkCadastrado');
Route::get('/aluno/listar', 'AlunoController@listar')->name('aluno.listar')->middleware('checkCadastrado');
Route::get('/aluno/buscar', 'AlunoController@buscar')->name('aluno.buscar')->middleware('checkCadastrado');
Route::get('/aluno/buscarCPF', 'AlunoController@buscarCPF')->name('aluno.buscarCPF')->middleware('checkCadastrado');
Route::get('/aluno/buscarAluno', 'AlunoController@buscarAluno')->name('aluno.buscarAluno')->middleware('checkCadastrado');
Route::get('/aluno/{id_aluno}/gerenciar', 'AlunoController@gerenciar')->name('aluno.gerenciar')->middleware('checkGerenciaAluno');
Route::get('/aluno/{id_aluno}/editar', 'AlunoController@editar')->name('aluno.editar')->middleware('checkGerenciaAlunoAdministrador');
Route::get('/aluno/{id_aluno}/excluir', 'AlunoController@excluir')->name('aluno.excluir')->middleware('checkGerenciaAlunoAdministrador');
Route::post('/aluno/criar', 'AlunoController@criar')->name('aluno.criar');
Route::post('/aluno/atualizar', 'AlunoController@atualizar')->name('aluno.atualizar');

//Rotas para permissões
Route::get('/aluno/{id_aluno}/gerenciar/permissoes/listar','AlunoController@gerenciarPermissoes')->name('aluno.permissoes')->middleware('checkGerenciaAlunoAdministrador');
Route::get('/aluno/{id_aluno}/gerenciar/permissoes/cadastrar','AlunoController@cadastrarPermissao')->name('aluno.permissoes.cadastrar')->middleware('checkGerenciaAlunoAdministrador');
Route::get('/aluno/{cpf}/gerenciar/permissoes/requisitar', 'AlunoController@requisitarPermissao')->name('aluno.permissoes.requisitar')->middleware('checkCadastrado');
Route::get('/aluno/gerenciar/permissoes/{id_permissao}/editar','AlunoController@editarPermissao')->name('aluno.permissoes.editar')->middleware('checkGerenciaAlunoAdministrador');
Route::get('/aluno/gerenciar/permissoes/{id_permissao}/remover','AlunoController@removerPermissao')->name('aluno.permissoes.remover')->middleware('checkGerenciaAlunoAdministrador');
Route::get('/aluno/gerenciar/permissoes/notificacao/{id_notificacao}/conceder', 'AlunoController@concederPermissao')->name('aluno.permissoes.conceder')->middleware('checkNotificacao');
Route::post('/aluno/gerenciar/permissoes/criar','AlunoController@criarPermissao')->name('aluno.permissoes.criar');
Route::post('/aluno/gerenciar/permissoes/notificar','AlunoController@notificarPermissao')->name('aluno.permissoes.notificar');
Route::post('/aluno/gerenciar/permissoes/atualizar','AlunoController@atualizarPermissao')->name('aluno.permissoes.atualizar');

//Rotas para objetivos
Route::get('/aluno/{id_aluno}/objetivos/cadastrar','ObjetivoController@cadastrar')->name('objetivo.cadastrar')->middleware('checkNaoResponsavel');
Route::get('/aluno/{id_aluno}/objetivos/listar','ObjetivoController@listar')->name('objetivo.listar')->middleware('checkGerenciaAluno');
Route::get('/aluno/objetivo/{id_objetivo}/gerenciar','ObjetivoController@gerenciar')->name('objetivo.gerenciar')->middleware('checkObjetivo');
Route::get('/aluno/objetivo/{id_objetivo}/gerenciar/finalizar','ObjetivoController@concluir')->name('objetivo.concluir')->middleware('checkObjetivoCriador');
Route::get('/aluno/objetivo/{id_objetivo}/gerenciar/reabrir','ObjetivoController@desconcluir')->name('objetivo.desconcluir')->middleware('checkObjetivoCriador');
Route::get('/aluno/objetivo/{id_objetivo}/gerenciar/editar','ObjetivoController@editar')->name('objetivo.editar')->middleware('checkObjetivoCriador');
Route::get('/aluno/objetivo/{id_objetivo}/gerenciar/excluir','ObjetivoController@excluir')->name('objetivo.excluir')->middleware('checkObjetivoCriador');
Route::get('/aluno/{id_aluno}/objetivos/buscar', 'ObjetivoController@buscar')->name('objetivo.buscar')->middleware('checkGerenciaAluno');
Route::post('/aluno/objetivo/atualizar', 'ObjetivoController@atualizar')->name('objetivo.atualizar');
Route::post('/aluno/objetivos/criar', 'ObjetivoController@criar')->name('objetivo.criar');

//Rotas para atividades
Route::get('/aluno/objetivo/{id_objetivo}/gerenciar/atividades/cadastrar','AtividadeController@cadastrar')->name('atividades.cadastrar')->middleware('checkObjetivoCriador');
Route::get('/aluno/objetivo/gerenciar/atividade/{id_atividade}/finalizar','AtividadeController@concluir')->name('atividade.concluir')->middleware('checkAtividadeCriador');
Route::get('/aluno/objetivo/gerenciar/atividade/{id_atividade}/reabrir','AtividadeController@desconcluir')->name('atividade.desconcluir')->middleware('checkAtividadeCriador');
Route::get('/aluno/objetivo/gerenciar/atividade/{id_atividade}/editar','AtividadeController@editar')->name('atividade.editar')->middleware('checkAtividadeCriador');
Route::get('/aluno/objetivo/gerenciar/atividade/{id_atividade}/excluir','AtividadeController@excluir')->name('atividade.excluir')->middleware('checkAtividadeCriador');
Route::post('/aluno/objetivos/gerenciar/atividades/criar', 'AtividadeController@criar')->name('atividades.criar');
Route::post('/aluno/atividade/atualizar', 'AtividadeController@atualizar')->name('atividade.atualizar');

//Rotas para sugestões
Route::get('/aluno/objetivo/{id_objetivo}/gerenciar/sugestoes/cadastrar','SugestaoController@cadastrar')->name('sugestoes.cadastrar')->middleware('checkObjetivoNaoCriador');
Route::get('/aluno/objetivo/gerenciar/sugestao/{id_sugestao}/ver','SugestaoController@ver')->name('sugestao.ver')->middleware('checkSugestao');
Route::get('/aluno/objetivo/gerenciar/sugestao/{id_sugestao}/editar','SugestaoController@editar')->name('sugestao.editar')->middleware('checkSugestaoCriador');
Route::get('/aluno/objetivo/gerenciar/sugestao/{id_sugestao}/excluir','SugestaoController@excluir')->name('sugestao.excluir')->middleware('checkSugestaoCriador');
Route::post('/aluno/objetivo/gerenciar/sugestoes/criar', 'SugestaoController@criar')->name('sugestoes.criar');
Route::post('/aluno/sugestao/atualizar', 'SugestaoController@atualizar')->name('objetivo.sugestao.atualizar');

//Rotas para feedbacks
Route::get('/aluno/objetivo/gerenciar/sugestao/feedback/{id_feedback}/excluir','FeedbackController@excluir')->name('feedback.excluir')->middleware('checkFeedbackCriador');
Route::post('/aluno/objetivo/gerenciar/sugestao/feedbacks/criar','FeedbackController@criar')->name('feedbacks.criar');
Route::post('/aluno/feedbacks/atualizar', 'FeedbackController@atualizar')->name('feedback.atualizar');

//Rotas para foruns
Route::get('/aluno/{id_aluno}/forum','ForumController@abrirForumAluno')->name('aluno.forum')->middleware('checkGerenciaAluno');
Route::post('/aluno/forum/mensagem/enviar','ForumController@enviarMensagemForumAluno')->name('aluno.forum.mensagem.enviar');
Route::post('/aluno/objetivo/forum/mensagem/enviar','ForumController@enviarMensagemForumObjetivo')->name('objetivo.forum.mensagem.enviar');
// Route::get('/aluno/objetivo/{id_objetivo}/forum','ForumController@abrirForumObjetivo')->name('objetivo.forum');

//Rotas para statuses
Route::post('/aluno/objetivo/status/atualizar', 'StatusController@atualizar')->name('objetivo.status.atualizar');

//Rotas para albuns
Route::get('/aluno/{id_aluno}/albuns/listar', 'AlbumController@listar')->name('album.listar')->middleware('checkGerenciaAluno');
Route::get('/aluno/{id_aluno}/albuns/cadastrar', 'AlbumController@cadastrar')->name('album.cadastrar')->middleware('checkGerenciaAluno');
Route::get('/aluno/albuns/{id_album}/ver', 'AlbumController@ver')->name('album.ver')->middleware('checkAlbum');
Route::get('/aluno/albuns/{id_album}/editar', 'AlbumController@editar')->name('album.editar')->middleware('checkAlbumCriador');
Route::get('/aluno/albuns/{id_album}/excluir', 'AlbumController@excluirAlbum')->name('album.excluir')->middleware('checkAlbumCriador');
Route::post('/aluno/albuns/fotos/excluir', 'AlbumController@excluirFotos')->name('album.fotos.excluir');
Route::post('/aluno/albuns/criar', 'AlbumController@criar')->name('album.criar');
Route::post('/aluno/albuns/atualizar', 'AlbumController@atualizar')->name('album.atualizar');

//Rotas para instituições
Route::get('/instituicao/cadastrar', 'InstituicaoController@cadastrar')->name('instituicao.cadastrar')->middleware('checkCadastrado');
Route::get('/instituicao/listar', 'InstituicaoController@listar')->name('instituicao.listar')->middleware('checkCadastrado');
Route::get('/instituicao/buscar', 'InstituicaoController@buscar')->name('instituicao.buscar')->middleware('checkCadastrado');
Route::get('/instituicao/{id_instituicao}/ver', 'InstituicaoController@ver')->name('instituicao.ver')->middleware('checkCadastrado');
Route::get('/instituicao/{id_instituicao}/editar', 'InstituicaoController@editar')->name('instituicao.editar')->middleware('checkInstituicaoCriador');
Route::get('/instituicao/{id_instituicao}/excluir', 'InstituicaoController@excluir')->name('instituicao.excluir')->middleware('checkInstituicaoCriador');
Route::post('/instituicao/criar', 'InstituicaoController@criar')->name('instituicao.criar');
Route::post('/instituicao/atualizar', 'InstituicaoController@atualizar')->name('instituicao.atualizar');
