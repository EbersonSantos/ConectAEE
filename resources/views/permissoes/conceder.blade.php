@extends('layouts.principal')
@section('title','Conceder permissão')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> <a href="{{route('aluno.permissoes',$aluno->id)}}">Acesso</a>
> Notificação
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Novo Acesso
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        @if (\Session::has('Fail'))
          <div class="alert alert-danger">
            <strong>Erro!</strong>
            {!! \Session::get('Fail') !!}
          </div>
        @endif

        <div class="panel-body panel-body-cadastro">
          <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route("aluno.permissoes.criar") }}">
              {{ csrf_field() }}

              <input type="hidden" name="id_aluno" value="{{$aluno->id}}">

              <div class="form-group{{ $errors->has('aluno') ? ' has-error' : '' }}">
                <label for="aluno" class="col-md-12 control-label">Aluno</label>

                <div class="col-md-12">
                  <input readonly id="aluno" type="text" class="form-control" name="aluno" value="{{ $aluno->nome }}" autofocus>

                  @if ($errors->has('aluno'))
                    <span class="help-block">
                      <strong>{{ $errors->first('aluno') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-12 control-label">Requerente</label>

                <div class="col-md-12">
                  <input readonly id="username" type="text" class="form-control" name="username" value="{{ $notificacao->remetente->username }}">

                  @if ($errors->has('username'))
                    <span class="help-block">
                      <strong>{{ $errors->first('username') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
                <label for="perfil" class="col-md-12 control-label">Perfil</label>

                <div class="col-md-12">
                  <input readonly id="perfil" type="text" class="form-control" name="perfil" value="{{ $notificacao->perfil->nome }}">

                  @if ($errors->has('perfil'))
                    <span class="help-block">
                      <strong>{{ $errors->first('perfil') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              @if($notificacao->perfil->nome == "Profissional Externo")
              <div id="div-especializacao" class="form-group{{ $errors->has('especializacao') ? ' has-error' : '' }}">
                @else
                <div id="div-especializacao" class="form-group{{ $errors->has('especializacao') ? ' has-error' : '' }}" style="display: none">
                  @endif
                  <label for="especializacao" class="col-md-12 control-label">Especialização</label>

                  <div class="col-md-12">
                    <input readonly id="especializacao" type="text" class="form-control" name="especializacao" value="{{ $notificacao->perfil->especializacao }}" autofocus>
                  </div>
                </div>

                <div class="form-check col-md-12">
                  <input id="isAdministrador" type="checkbox" class="form-check-input" name="isAdministrador" value="true">
                  <label class="form-check-label" for="isAdministrador">Usuário administrador</label>
                </div>

                <div class="form-group">
                  <div class="row col-md-12 text-center">
                    <br>
                    <button type="submit" class="btn btn-primary">
                      Conceder
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var perfil = document.getElementById("perfil").value;

    if (perfil == "Responsável") {
      var adm = document.getElementById("isAdministrador");
      adm.checked = true;
      adm.readonly = true;

      adm.onchange = function() {
        adm.checked=true;
      };
    }


  </script>
  @endsection
