@extends('layouts.principal')
@section('title','Listar permissões')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> Acessos
@endsection
@section('content')

@php($atual = App\Gerenciar::where('user_id','=',Auth::user()->id)->where('aluno_id','=',$aluno->id)->first())

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-12">
              <div style="width: 100%; margin-left: 0%;" class="row">
                <div style="width: 50%; float: left; margin-left:-20px;" class="col-md-6">
                  <h3>
                    <strong>Acesso</strong>
                  </h3>
                </div>
                <div style="width:50%; float:right; margin-right:-25px;margin-top:20px" class="col-md-6 text-right">
                  <a class="btn btn-primary" href="{{ route("aluno.permissoes.cadastrar",['id_aluno' => $aluno->id])}}">
                    Nova Permissão
                  </a>
                </div>
              </div>
            </div>
          </div>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body">
          @if (\Session::has('Success'))
            <br>
            <div class="alert alert-success">
              <strong>Sucesso!</strong>
              {!! \Session::get('Success') !!}
            </div>
          @endif
          @if (\Session::has('Removed'))
            <br>
            <div class="alert alert-success">
              <strong>Removido!</strong>
              {!! \Session::get('Removed') !!}
            </div>
          @endif

          <div id="tabela" class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width:22.5%">Nome</th>
                  <th style="width:22.5%">Contato</th>
                  <th style="width:22.5%">Perfil</th>
                  <th style="width:22.5%">Administrador</th>
                  <th style="width:10%">Ações</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gerenciars as $gerenciar)
                  <tr>
                    <td data-title="Nome">{{ $gerenciar->user->name }} </td>

                    <td data-title="Contato">
                      @if($gerenciar->user->email != null)
                        <strong>Email:</strong> {{ $gerenciar->user->email }}
                      @endif
                      <strong>Telefone:</strong> {{ $gerenciar->user->telefone }}
                    </td>

                    @if($gerenciar->perfil->especializacao == NULL)
                      <td data-title="Perfil/Especialização">{{ $gerenciar->perfil->nome }} </td>
                    @else
                      <td data-title="Perfil/Especialização">{{ $gerenciar->perfil->especializacao }} </td>
                    @endif

                    <td data-title="Administrador">{{ ($gerenciar->isAdministrador) ? 'Sim' : 'Não' }}</td>

                    @if($atual->isAdministrador)
                      @if(!($gerenciar->user->id == Auth::user()->id))
                        @if(!($gerenciar->isAdministrador))
                          <td data-title="Ações">
                            <a class="btn btn-primary" href='{{route('aluno.permissoes.editar',[$gerenciar->id])}}'>
                              Editar
                            </a>
                          </td>
                          <td data-title="">
                            <a class="btn btn-danger" href='{{route('aluno.permissoes.remover',[$gerenciar->id])}}' onclick="return confirm('Essa ação removerá as permissões de {{$gerenciar->user->name}}. Deseja prosseguir?')">
                              Excluir
                            </a>
                          </td>
                        @else
                          <td></td>
                          <td></td>
                        @endif
                      @else
                        <td></td>
                        <td></td>
                      @endif
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- <div class="panel-footer">
          <a class="btn btn-danger" href="{{URL::previous()}}">
            <i class="material-icons">keyboard_backspace</i>
            <br>
            Voltar
          </a>
        </div> -->

      </div>
    </div>
  </div>
</div>

@endsection
